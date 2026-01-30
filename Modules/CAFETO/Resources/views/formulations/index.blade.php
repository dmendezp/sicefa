@extends('cafeto::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/cafeto/css/formulations/index.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.formulations.index') }}"
           class="text-decoration-none">{{ trans('cafeto::formulations.Breadcrumb_Formulations_1') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('cafeto::formulations.Breadcrumb_Active_Formulations_1') }}</li>
@endpush

@section('content')
@php
    /**
     * Parsea proccess: JSON {"status":"approved","process":"..."} o legacy "approved"/"pending"
     * Devuelve: ['status' => 'approved|pending|...', 'process' => string|null]
     */
    $parseProccess = function ($value) {
        $raw = is_null($value) ? '' : (string) $value;
        $rawTrim = trim($raw);

        if ($rawTrim === '') return ['status' => 'pending', 'process' => null];

        $decoded = json_decode($rawTrim, true);
        if (is_array($decoded) && (array_key_exists('status', $decoded) || array_key_exists('process', $decoded))) {
            $status = isset($decoded['status']) && is_string($decoded['status']) && $decoded['status'] !== ''
                ? $decoded['status']
                : 'pending';

            $process = isset($decoded['process']) && is_string($decoded['process'])
                ? trim($decoded['process'])
                : null;

            $process = ($process !== '') ? $process : null;

            return ['status' => $status, 'process' => $process];
        }

        if (in_array($rawTrim, ['approved', 'pending'], true)) return ['status' => $rawTrim, 'process' => null];

        return ['status' => ($rawTrim ?: 'pending'), 'process' => null];
    };

    $routePrefix = getRoleRouteName(Route::currentRouteName());
    $isCashier = $routePrefix === 'cashier';
    $isAdminOrInstructor = in_array($routePrefix, ['admin','instructor'], true);

    // ✅ user person id para validar "propias"
    $personId = auth()->check()
        ? (auth()->user()->person ? auth()->user()->person->id : auth()->id())
        : null;

    /**
     * Permisos/rutas: NO dependen de $formulation (evita "Variable indefinida $formulation")
     */
    $can = function (string $action) use ($routePrefix) {
        $routeName = "cafeto.{$routePrefix}.formulations.{$action}";
        $permSlug  = "cafeto.{$routePrefix}.formulations.{$action}";
        return \Illuminate\Support\Facades\Route::has($routeName)
            && \Illuminate\Support\Facades\Auth::check()
            && \Illuminate\Support\Facades\Auth::user()->havePermission($permSlug);
    };

    $hasRoute = function (string $action) use ($routePrefix) {
        return \Illuminate\Support\Facades\Route::has("cafeto.{$routePrefix}.formulations.{$action}");
    };

    $statusLabel = function (?string $status) {
        $key = 'cafeto::formulations.status.' . ($status ?: 'pending');
        $label = trans($key);
        return $label === $key ? trans('cafeto::formulations.status.pending') : $label;
    };

    /**
     * Reglas UI:
     * - Aprobar: solo admin/instructor y solo si NO está aprobada
     * - Editar:
     *   - admin/instructor: según permiso (edit)
     *   - cajero: solo si NO está aprobada Y es suya
     */
    $canApproveUi = function (string $status) use ($isAdminOrInstructor, $can) {
        return $isAdminOrInstructor && $status !== 'approved' && $can('approve');
    };

    $canEditUi = function ($formulation, string $status) use ($isCashier, $isAdminOrInstructor, $can, $personId) {
        if (!$can('edit')) return false;

        if ($isAdminOrInstructor) return true;

        if ($isCashier) {
            $isOwner = $personId !== null && (int) $formulation->person_id === (int) $personId;
            return $isOwner && $status !== 'approved';
        }

        return false;
    };

    $canDestroyUi = function () use ($can) {
        return $can('destroy');
    };
@endphp

<div class="card custom-card" data-aos="fade-up">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
            <h5 class="text-center text-light">{{ trans('cafeto::formulations.Title_Formulations') }}</h5>

            <div class="d-flex gap-2">
                @if ($can('create'))
                    <a href="{{ route('cafeto.' . $routePrefix . '.formulations.create') }}"
                       class="btn btn-dark btn-sm"
                       data-bs-toggle="tooltip" data-bs-placement="top"
                       title="{{ trans('cafeto::formulations.Tooltip_Create') }}">
                        <i class="fa-solid fa-file-circle-plus fa-fade me-1"></i>
                        {{ trans('cafeto::formulations.Create New Formulation') }}
                    </a>
                @endif

                <button class="btn btn-export btn-sm" onclick="exportTable('csv')"
                        data-bs-toggle="tooltip" data-bs-placement="top"
                        title="{{ trans('cafeto::formulations.Tooltip_Export_CSV') }}">
                    <i class="fas fa-file-csv"></i> CSV
                </button>

                <button class="btn btn-export btn-sm" onclick="exportTable('pdf')"
                        data-bs-toggle="tooltip" data-bs-placement="top"
                        title="{{ trans('cafeto::formulations.Tooltip_Export_PDF') }}">
                    <i class="fas fa-file-pdf"></i> PDF
                </button>
            </div>
        </div>

        <hr class="border-secondary">

        <div class="filter-bar" data-aos="fade-down" data-aos-delay="100">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" id="filter-element" class="form-control"
                               placeholder="{{ trans('cafeto::formulations.Filter_Element') }}"
                               oninput="debouncedFilterTable()">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-filter"></i></span>
                        <select id="filter-status" class="form-select" onchange="debouncedFilterTable()">
                            <option value="">{{ trans('cafeto::formulations.All_Statuses') }}</option>
                            <option value="approved">{{ trans('cafeto::formulations.Approved') }}</option>
                            <option value="pending">{{ trans('cafeto::formulations.Pending') }}</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                        <input type="date" id="filter-date" class="form-control" oninput="debouncedFilterTable()">
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success" data-aos="fade-in">
                {{ session('success') }}
            </div>
        @endif

        @if ($formulations->isEmpty())
            <p class="text-center text-light" data-aos="fade-in">
                {{ trans('cafeto::formulations.No formulations found') }}
            </p>
        @else
            <div class="table-responsive" data-aos="zoom-in">
                <table class="table table-dark table-hover" id="tableFormulations">
                    <thead class="sticky-header">
                        <tr>
                            <th>{{ trans('cafeto::formulations.Element') }}</th>
                            <th class="text-center">{{ trans('cafeto::formulations.Amount') }}</th>
                            <th>{{ trans('cafeto::formulations.Date') }}</th>
                            <th>{{ trans('cafeto::formulations.Status') }}</th>
                            <th class="text-center">{{ trans('cafeto::formulations.Actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($formulations as $formulation)
                            @php
                                $meta = $parseProccess($formulation->proccess);
                                $status = $meta['status'];
                                $processText = $meta['process'];
                            @endphp

                            <tr class="table-row" onclick="toggleDetails(this, {{ $formulation->id }})" style="cursor:pointer">
                                <td>{{ $formulation->element ? $formulation->element->name : trans('cafeto::formulations.None') }}</td>
                                <td class="text-center">{{ $formulation->amount }}</td>
                                <td>{{ $formulation->date }}</td>
                                <td>
                                    <span class="status-badge badge {{ $status === 'approved' ? 'bg-approved' : 'bg-pending' }}"
                                          data-status="{{ $status }}">
                                        {{ $statusLabel($status) }}
                                    </span>

                                    @if ($processText)
                                        <div class="small text-light opacity-75 mt-1" style="line-height: 1.15;">
                                            {{ $processText }}
                                        </div>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        @if ($hasRoute('show'))
                                            <a href="{{ route('cafeto.' . $routePrefix . '.formulations.show', $formulation->id) }}"
                                               class="btn btn-outline-light btn-sm"
                                               data-bs-toggle="tooltip" data-bs-placement="top"
                                               title="{{ trans('cafeto::formulations.View') }}"
                                               onclick="event.stopPropagation();">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        @endif

                                        @if ($canEditUi($formulation, $status))
                                            <a href="{{ route('cafeto.' . $routePrefix . '.formulations.edit', $formulation->id) }}"
                                               class="btn btn-outline-light btn-sm"
                                               data-bs-toggle="tooltip" data-bs-placement="top"
                                               title="{{ trans('cafeto::formulations.Edit') }}"
                                               onclick="event.stopPropagation();">
                                                <i class="fa-solid fa-edit"></i>
                                            </a>
                                        @endif

                                        @if ($canDestroyUi())
                                            <form action="{{ route('cafeto.' . $routePrefix . '.formulations.destroy', $formulation->id) }}"
                                                  method="POST" class="d-inline" onsubmit="event.stopPropagation();">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-outline-light btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="{{ trans('cafeto::formulations.Delete') }}"
                                                        onclick="return handleDelete(event, '{{ trans('cafeto::formulations.Are you sure?') }}')">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif

                                        @if ($canApproveUi($status) && $hasRoute('approve'))
                                            <a href="{{ route('cafeto.' . $routePrefix . '.formulations.approve', $formulation->id) }}"
                                               class="btn btn-outline-light btn-sm"
                                               data-bs-toggle="tooltip" data-bs-placement="top"
                                               title="{{ trans('cafeto::formulations.Approve') }}"
                                               onclick="event.stopPropagation();">
                                                <i class="fa-solid fa-check"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <tr class="details-row" id="details-{{ $formulation->id }}" style="display:none;">
                                <td colspan="5">
                                    <div class="p-3">
                                        <h6 class="text-light">{{ trans('cafeto::formulations.Ingredients') }}</h6>

                                        @if(!empty($formulation->ingredients) && $formulation->ingredients->count() > 0)
                                            <ul class="text-light mb-0">
                                                @foreach ($formulation->ingredients as $ingredient)
                                                    <li>
                                                        {{ $ingredient->element ? $ingredient->element->name : trans('cafeto::formulations.Dash') }}:
                                                        {{ $ingredient->amount }} g
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <div class="text-light opacity-75">{{ trans('cafeto::formulations.Dash') }}</div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Mobile cards --}}
            @foreach ($formulations as $formulation)
                @php
                    $meta = $parseProccess($formulation->proccess);
                    $status = $meta['status'];
                    $processText = $meta['process'];
                @endphp

                <div class="mobile-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <h6 class="text-light">{{ $formulation->element ? $formulation->element->name : trans('cafeto::formulations.None') }}</h6>

                    <p class="text-light">
                        <strong>{{ trans('cafeto::formulations.Amount') }}:</strong> {{ $formulation->amount }}
                    </p>

                    <p class="text-light">
                        <strong>{{ trans('cafeto::formulations.Date') }}:</strong> {{ $formulation->date }}
                    </p>

                    <p class="text-light">
                        <strong>{{ trans('cafeto::formulations.Status') }}:</strong>
                        <span class="status-badge badge {{ $status === 'approved' ? 'bg-approved' : 'bg-pending' }}"
                              data-status="{{ $status }}">
                            {{ $statusLabel($status) }}
                        </span>

                        @if ($processText)
                            <br>
                            <span class="small text-light opacity-75">{{ $processText }}</span>
                        @endif
                    </p>

                    <div class="d-flex justify-content-center gap-1">
                        @if ($hasRoute('show'))
                            <a href="{{ route('cafeto.' . $routePrefix . '.formulations.show', $formulation->id) }}"
                               class="btn btn-outline-light btn-sm"
                               data-bs-toggle="tooltip" data-bs-placement="top"
                               title="{{ trans('cafeto::formulations.View') }}">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        @endif

                        @if ($canEditUi($formulation, $status))
                            <a href="{{ route('cafeto.' . $routePrefix . '.formulations.edit', $formulation->id) }}"
                               class="btn btn-outline-light btn-sm"
                               data-bs-toggle="tooltip" data-bs-placement="top"
                               title="{{ trans('cafeto::formulations.Edit') }}">
                                <i class="fa-solid fa-edit"></i>
                            </a>
                        @endif

                        @if ($canDestroyUi())
                            <form action="{{ route('cafeto.' . $routePrefix . '.formulations.destroy', $formulation->id) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-outline-light btn-sm"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="{{ trans('cafeto::formulations.Delete') }}"
                                        onclick="return handleDelete(event, '{{ trans('cafeto::formulations.Are you sure?') }}')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        @endif

                        @if ($canApproveUi($status) && $hasRoute('approve'))
                            <a href="{{ route('cafeto.' . $routePrefix . '.formulations.approve', $formulation->id) }}"
                               class="btn btn-outline-light btn-sm"
                               data-bs-toggle="tooltip" data-bs-placement="top"
                               title="{{ trans('cafeto::formulations.Approve') }}">
                                <i class="fa-solid fa-check"></i>
                            </a>
                        @endif
                    </div>

                    <div class="mobile-details mt-2" id="mobile-details-{{ $formulation->id }}" style="display:none;">
                        <h6 class="text-light">{{ trans('cafeto::formulations.Ingredients') }}</h6>

                        @if(!empty($formulation->ingredients) && $formulation->ingredients->count() > 0)
                            <ul class="text-light mb-0">
                                @foreach ($formulation->ingredients as $ingredient)
                                    <li>
                                        {{ $ingredient->element ? $ingredient->element->name : trans('cafeto::formulations.Dash') }}:
                                        {{ $ingredient->amount }} g
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="text-light opacity-75">{{ trans('cafeto::formulations.Dash') }}</div>
                        @endif
                    </div>

                    <button class="btn btn-link text-light" onclick="toggleMobileDetails({{ $formulation->id }})">
                        {{ trans('cafeto::formulations.Show_Details') }}
                    </button>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection

@include('cafeto::layouts.partials.plugins.sweetalert2')
@include('cafeto::layouts.partials.plugins.datatables')

@push('scripts')
<script src="{{ asset('libs/AOS-2.3.1/dist/aos.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
    AOS.init();

    function toggleDetails(row, id) {
        const detailsRow = document.getElementById(`details-${id}`);
        if (!detailsRow) return;
        detailsRow.style.display = detailsRow.style.display === 'table-row' ? 'none' : 'table-row';
    }

    function toggleMobileDetails(id) {
        const details = document.getElementById(`mobile-details-${id}`);
        if (!details) return;
        details.style.display = details.style.display === 'block' ? 'none' : 'block';
    }

    function handleDelete(event, message) {
        event.preventDefault();

        Swal.fire({
            title: '{{ trans('cafeto::formulations.Confirm Delete') }}',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{ trans('cafeto::formulations.Yes, delete it!') }}',
            cancelButtonText: '{{ trans('cafeto::formulations.Cancel') }}'
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.closest('form').submit();
            }
        });

        return false;
    }

    function debouncedFilterTable() {
        clearTimeout(window.filterTimeout);
        window.filterTimeout = setTimeout(filterTable, 300);
    }

    function filterTable() {
        const elementFilter = document.getElementById('filter-element').value.toLowerCase();
        const statusFilter = document.getElementById('filter-status').value;
        const dateFilter = document.getElementById('filter-date').value;

        const rows = document.querySelectorAll('#tableFormulations tbody tr.table-row');

        rows.forEach(row => {
            const element = row.cells[0].textContent.toLowerCase();
            const status = row.cells[3].querySelector('.status-badge')?.dataset?.status?.trim().toLowerCase() || '';
            const date = row.cells[2].textContent.trim();

            const matchesElement = element.includes(elementFilter);
            const matchesStatus  = !statusFilter || status === statusFilter;
            const matchesDate    = !dateFilter || date === dateFilter;

            row.style.display = (matchesElement && matchesStatus && matchesDate) ? '' : 'none';

            const detailsRow = row.nextElementSibling;
            if (detailsRow && detailsRow.classList.contains('details-row')) {
                detailsRow.style.display = 'none';
            }
        });
    }

    function exportTable(format) {
        const headers = [
            '{{ trans('cafeto::formulations.Element') }}',
            '{{ trans('cafeto::formulations.Amount') }}',
            '{{ trans('cafeto::formulations.Date') }}',
            '{{ trans('cafeto::formulations.Status') }}',
            '{{ trans('cafeto::formulations.Process') }}'
        ];

        if (format === 'csv') {
            let csv = `"${headers.join('","')}"\n`;
            document.querySelectorAll('#tableFormulations tbody tr.table-row').forEach(row => {
                const element = row.cells[0].textContent.trim();
                const amount  = row.cells[1].textContent.trim();
                const date    = row.cells[2].textContent.trim();
                const status  = row.cells[3].querySelector('.status-badge')?.dataset?.status || '';
                const process = row.cells[3].querySelector('.small')?.textContent.trim() || '';
                csv += `"${element}","${amount}","${date}","${status}","${process}"\n`;
            });

            const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'formulations.csv';
            link.click();
            return;
        }

        if (format === 'pdf') {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            doc.text('{{ trans('cafeto::formulations.Formulations Report') }}', 10, 10);

            let y = 20;
            document.querySelectorAll('#tableFormulations tbody tr.table-row').forEach(row => {
                const element = row.cells[0].textContent.trim();
                const amount  = row.cells[1].textContent.trim();
                const date    = row.cells[2].textContent.trim();
                const status  = row.cells[3].querySelector('.status-badge')?.dataset?.status || '';
                const process = row.cells[3].querySelector('.small')?.textContent.trim() || '';

                doc.text(`${headers[0]}: ${element} | ${headers[1]}: ${amount} | ${headers[2]}: ${date} | ${headers[3]}: ${status}`, 10, y);
                y += 8;

                if (process) {
                    doc.text(`${headers[4]}: ${process}`, 10, y);
                    y += 8;
                }

                if (y > 280) { doc.addPage(); y = 20; }
            });

            doc.save('formulations.pdf');
        }
    }
</script>
@endpush
