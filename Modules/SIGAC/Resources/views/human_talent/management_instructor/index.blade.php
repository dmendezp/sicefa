@extends('sigac::layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-blue card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 pr-3 pb-3">
                                <form action="{{ route('sigac.academic_coordination.human_talent.management_instructor.profession_instructor.store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        {!! Form::label('instructor',  trans('sigac::profession.Instructor')) !!}
                                        {!! Form::select('instructor', $instructors, old('instructor'), ['class' => 'form-control instructor'],) !!}                                    
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('profession',  trans('sigac::profession.Profession')) !!}
                                        {!! Form::select('profession', $professions, old('profession'), ['class' => 'form-control learningOutCome'],) !!}                                         
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success">{{ trans('sigac::profession.Add')}}</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table id="personProfession" class="display table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-center">{{ trans('sigac::profession.Instructor')}}</th>
                                                <th class="text-center">{{trans ('sigac::profession.Profession')}}</th>
                                                <th class="text-center">{{ trans('sigac::profession.Actions')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($person_profession as $p)
                                            @php
                                                $person = DB::table('people')->where('id', $p->person_id)->first();
                                                $profession = DB::table('professions')->where('id', $p->profession_id)->first();
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{ $person->first_name . ' ' . $person->first_last_name . ' ' . $person->second_last_name }}</td>
                                                <td class="text-center">{{ $profession->name }}</td>
                                                <td class="text-center">
                                                    <a class="delete-person_profession" data-person_profession-id="{{ $p->id }}">
                                                        <b class="text-danger" data-toggle="tooltip" data-placement="top" title="{{ trans('sigac::profession.Eliminate')}}">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </b>
                                                    </a>
                                                </td>
                                                <form id="delete-person_profession-form-{{ $p->id }}"
                                                    action="{{ route('sigac.academic_coordination.human_talent.management_instructor.profession_instructor.destroy', ['id' => $p->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
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
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>


<script>
    $(document).ready(function() {
        $('#personProfession').DataTable({
            columnDefs: [
                { orderable: false, targets: 2 }
            ]
        });

            $('.instructor').select2();
            $('.learningOutCome').select2();

        // Usar la delegación de eventos en lugar de eventos directos
        $(document).on('click', '.delete-person_profession', function(event) {
            var profession_program_id = $(this).data('person_profession-id');

            // Mostrar SweetAlert para confirmar la eliminación
            Swal.fire({
                title: '{{trans('sigac::profession.You_Sure')}}',
                text: '{{trans('sigac::profession.This_Action_Can_Undone')}}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '{{trans('sigac::profession.Yes_Delete')}}'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, enviar el formulario de eliminación
                    document.getElementById('delete-person_profession-form-' + profession_program_id).submit();
                }
            });
        });
    });
</script>
