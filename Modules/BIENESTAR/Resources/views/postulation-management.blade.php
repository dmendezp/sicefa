@php
$role_name = getRoleRouteName(Route::currentRouteName());
@endphp

@extends('bienestar::layouts.master')

@section('content')
<div class="container">
    <h1>{{ trans('bienestar::menu.Application Management') }} <i class="far fa-smile" style="color: #000000;"></i></h1>
    <div class="container">

        <div class="row justify-content-md-center pt-4">
            <div class="card shadow col-md-12">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="benefitsTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>{{ trans('bienestar::menu.Apprentice Name') }}</th>
                                    <th>{{ trans('bienestar::menu.Benefit to which you are applying') }}</th>
                                    <th>{{ trans('bienestar::menu.Select') }}</th>
                                    <th>{{ trans('bienestar::menu.State and profit') }}</th>
                                    <th>{{ trans('bienestar::menu.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($postulation as $postulation)
                                <tr>
                                    <form action="{{ route('bienestar.admin.update-benefits.postulation-management') }}" method="post" class="formGuardar">
                                        @csrf
                                        <td>{{ $postulation->first_name }} {{ $postulation->first_last_name }}
                                            {{ $postulation->second_last_name }}
                                            <input type="hidden" class="postulation_id" name="postulation_id" value="{{ $postulation->id }}">
                                        </td>
                                        <td>
                                            @if ($postulation->transportation_benefit == 1)
                                            Transporte
                                            @endif <br>
                                            @if ($postulation->feed_benefit == 1)
                                            Alimentación
                                            @endif
                                        </td>
                                        <td>
                                            @if ($postulation->transportation_benefit == 1)
                                            <select class="form-control" name="benefit_id_transport" id="benefit_id_transport{{ $postulation->id }}">
                                                <option value="">Seleccione el beneficio</option>
                                                @foreach ($benefits as $benefit)
                                                @if ($benefit->name == 'Transporte')
                                                <option value="{{ $benefit->id }}" {{ $postulation->postulationBenefits->where('benefit_id', $benefit->id)->isNotEmpty() ? 'selected' : '' }}>
                                                    {{ $benefit->name }} {{ $benefit->porcentege }}
                                                </option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @endif
                                            <br>
                                            @if ($postulation->feed_benefit == 1)
                                            <select class="form-control" name="benefit_id_food" id="benefit_id_food{{ $postulation->id }}">
                                                <option value="">Seleccione el beneficio</option>
                                                @foreach ($benefits as $benefit)
                                                @if ($benefit->name == 'Alimentacion')
                                                <option value="{{ $benefit->id }}" {{ $postulation->postulationBenefits->where('benefit_id', $benefit->id)->isNotEmpty() ? 'selected' : '' }}>
                                                    {{ $benefit->name }} {{ $benefit->porcentege }}
                                                </option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                @foreach ($postulationsbentfits as $pb)
                                                @if ($postulation->id == $pb->postulation_id && $pb->state == 'Beneficiario' && $postulation->transportation_benefit == 1)
                                                <input type="hidden" name="postulationsbentfits_id" value="{{ $pb->id }}">
                                                <div>
                                                    @foreach ($benefits as $benefit)
                                                    @if ($benefit->id == $pb->benefit_id && $benefit->name == 'Transporte')
                                                    {{ $pb->state }}
                                                    {{ $benefit->name }}
                                                    {{ $benefit->porcentege }}%
                                                    @endif
                                                    @endforeach
                                                </div>
                                                @elseif ($postulation->id == $pb->postulation_id && $pb->state != 'Beneficiario' && $postulation->transportation_benefit == 1)
                                                <div>
                                                    {{ $pb->state }}
                                                </div>
                                                @endif
                                                @endforeach
                                            </div>
                                            <div class="d-flex flex-column">
                                                @foreach ($postulationsbentfits as $pb)
                                                @if ($postulation->id == $pb->postulation_id && $pb->state == 'Beneficiario' && $postulation->feed_benefit == 1)
                                                <input type="hidden" name="postulationsbentfits_id" value="{{ $pb->id }}">
                                                <div>
                                                    @foreach ($benefits as $benefit)
                                                    @if ($benefit->id == $pb->benefit_id && $benefit->name == 'Alimentacion')
                                                    {{ $pb->state }}
                                                    {{ $benefit->name }}
                                                    {{ $benefit->porcentege }}%
                                                    @endif
                                                    @endforeach
                                                </div>
                                                @elseif ($postulation->id == $pb->postulation_id && $pb->state != 'Beneficiario' && $postulation->feed_benefit == 1)
                                                <div>
                                                    {{ $pb->state }}
                                                </div>
                                                @endif
                                                @endforeach
                                            </div>
                                        </td>

                                        <!-- Agrega esto donde estás mostrando tus filas de datos -->
                                        <td style="align-items: center">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <button type="button" class="btn btn-primary mx-2" data-toggle="modal" data-target="#myModal{{ $postulation->id }}">
                                                    {{ trans('bienestar::menu.View Details') }}
                                                </button>

                                                @php
                                                $existingRecord = $postulationsbentfits->where('postulation_id', $postulation->id)->first();
                                                @endphp
                                                @if (!$existingRecord)
                                                <button type="submit" class="btn btn-success mx-2">{{ trans('bienestar::menu.Save') }}</button>
                                                @else
                                                <button type="submit" class="btn btn-success mx-2">{{ trans('bienestar::menu.Update') }}</button>
                                                @endif
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="myModal{{ $postulation->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel">{{ trans('bienestar::menu.Details of the Application') }}</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>
                                                            <h5>{{ trans('bienestar::menu.Apprentice Name') }}:</h5> {{ $postulation->first_name }}
                                                            {{ $postulation->first_last_name }}
                                                            {{ $postulation->second_last_name }}
                                                            </p>

                                                            <!-- Preguntas y respuestas relacionadas -->
                                                            <h5>{{ trans('bienestar::menu.Application Questions') }}</h5>
                                                            @foreach ($answers as $answer)
                                                            @if ($answer->postulation_id == $postulation->id)
                                                            <div class="form-group">
                                                                <label for="question">{{ $answer->question->question }}</label>
                                                                <input type="text" class="form-control col-md-4" name="answers[{{ $answer->question }}]" value="{{ $answer->answer }}" readonly>
                                                            </div>
                                                            @endif
                                                            @endforeach
                                                            <div class="form-group">
                                                                @php
                                                                $transporteSelected = $postulation->postulationBenefits->where('benefit.name', 'Transporte')->isNotEmpty();
                                                                $alimentacionSelected = $postulation->postulationBenefits->where('benefit.name', 'Alimentacion')->isNotEmpty();
                                                                @endphp

                                                                @if ($transporteSelected && $alimentacionSelected)
                                                                <label for="message">{{ trans('bienestar::menu.Transportation - Message') }}</label>
                                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="messageT" rows="3" id="message" placeholder="Ingrese mensaje para Transporte" required>{{ $postulation->postulationBenefits->where('benefit.name', 'Transporte')->first()->message }}</textarea>
                                                                <input type="hidden" name="postulationbenefitstransportID" value="{{ $postulation->postulationBenefits->where('benefit.name', 'Transporte')->first()->id }}">

                                                                <label for="message">{{ trans('bienestar::menu.Food - Message') }}</label>
                                                                <textarea class="form-control" id="exampleFormControlTextarea2" name="messageA" rows="3" id="message2" placeholder="Ingrese mensaje para Alimentacion" required>{{ $postulation->postulationBenefits->where('benefit.name', 'Alimentacion')->first()->message }}</textarea>
                                                                <input type="hidden" name="postulationbenefitsalimentacionID" value="{{ $postulation->postulationBenefits->where('benefit.name', 'Alimentacion')->first()->id }}">

                                                                @elseif ($transporteSelected)
                                                                <label for="message">{{ trans('bienestar::menu.Transportation - Message') }}</label>
                                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="messageT" rows="3" id="message" placeholder="Ingrese mensaje para Transporte" required>{{ $postulation->postulationBenefits->where('benefit.name', 'Transporte')->first()->message }}</textarea>
                                                                <input type="hidden" name="postulationbenefitstransportID" value="{{ $postulation->postulationBenefits->where('benefit.name', 'Transporte')->first()->id }}">

                                                                @elseif ($alimentacionSelected)
                                                                <label for="message">{{ trans('bienestar::menu.Food - Message') }}</label>
                                                                <textarea class="form-control" id="exampleFormControlTextarea2" name="messageA" rows="3" id="message2" placeholder="Ingrese mensaje para Alimentacion" required>{{ $postulation->postulationBenefits->where('benefit.name', 'Alimentacion')->first()->message }}</textarea>
                                                                <input type="hidden" name="postulationbenefitsalimentacionID" value="{{ $postulation->postulationBenefits->where('benefit.name', 'Alimentacion')->first()->id }}">

                                                                @else
                                                                <label for="message">{{ trans('bienestar::menu.Enter message for benefit') }}</label>
                                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="message" id="message" rows="3" placeholder="Ingrese mensaje para beneficio" required></textarea>
                                                                @endif
                                                            </div>
                                                            <!-- Agregar sección para mostrar archivos socioeconómicos -->
                                                            @if ($postulation->socioeconomicsupportfiles->isNotEmpty())
                                                            <h4>Archivos Socioeconómicos:</h4>
                                                            <div class="card-deck">
                                                                @foreach ($postulation->socioeconomicsupportfiles as $file)
                                                                    <li class="card mb-3" style="max-width: 18rem;">
                                                                        <div class="card-body" style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                                                                            @php
                                                                                $extension = pathinfo($file->file_path, PATHINFO_EXTENSION);
                                                                                $imageName = pathinfo($file->file_path, PATHINFO_FILENAME);
                                                                                $iconPath = asset('modules/bienestar/icons/' . $extension . '.svg');
                                                                                $truncatedName = (strlen($imageName) > 20) ? substr($imageName, 0, 20) . '...' : $imageName;
                                                                                $filePath = asset($file->file_path);
                                                                            @endphp

                                                                            <!-- Icono -->
                                                                            <img src="{{ $iconPath }}" alt="{{ $extension }} icon" style="width: 40px; height: 40px; margin-bottom: 10px;">

                                                                            <!-- Nombre del archivo -->
                                                                            <p>
                                                                                <strong class="card-title">{{ $truncatedName }} ({{ $extension }})</strong>
                                                                            </p>

                                                                            <!-- Agregar el botón de descarga -->
                                                                            <a href="{{ $filePath }}" download="{{ basename($file->file_path) }}" class="btn btn-primary btn-sm">
                                                                                Descargar
                                                                            </a>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </div>
                                                            @else
                                                            <p>No hay archivos socioeconómicos asociados a esta postulación.</p>
                                                            @endif

                                                            <div class="form-group">
                                                                <label for="message">{{ trans('bienestar::menu.Score') }}</label>
                                                                <input type="number" class="form-control" name="score" id="score" value="{{ $postulation->total_score }}" required>
                                                            </div>
                                                            @foreach ($postulationsbentfits as $pb)
                                                            <div class="form-group">
                                                                @if ($postulation->id == $pb->postulation_id)
                                                                <input type="hidden" name="postulationsbentfits_id" value="{{ $pb->id }}">
                                                                <a href="{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.remove-benefit.postulation-management', [$pb->id]) }}" class="btn btn-danger formEliminar">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                    <p>{{ trans('bienestar::menu.Remove Benefit') }} @foreach ($benefits as $benefit)
                                                                        @if ($benefit->id == $pb->benefit_id)
                                                                        {{ $benefit->name }}
                                                                        {{ $benefit->porcentege }}%
                                                                        @endif
                                                                        @endforeach
                                                                    </p>
                                                                </a>
                                                                @endif
                                                            </div>
                                                            @endforeach

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('bienestar::menu.Close')}}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection