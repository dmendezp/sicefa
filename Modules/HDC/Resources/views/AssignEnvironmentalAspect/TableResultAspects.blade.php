    <div class="col-md-12">
        <div class="card card-success card-outline shadow mt-2">
            <div class="card-header">
                <h2 class="card-title"><strong>Aspectos Ambientales guardados</strong></h2>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="myTable">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>{{ trans('hdc::ConsumptionRegistry.Title_Header_Table_Column_Activities') }}</th>
                                <th>{{ trans('hdc::ConsumptionRegistry.Title_Header_Table_Column_Environmental_Aspect') }}
                                </th>
                                <th>{{ trans('hdc::ConsumptionRegistry.Title_Header_Table_Column_Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($result as $resultados )


                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <form action="" method="post" id="formEliminar">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btnEliminar" type="button"
                                        data-form-id="formEliminar">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                <a href="" class="btn btn-primary btnUpdat">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const deleteButtons = document.querySelectorAll('.btnEliminar');

            deleteButtons.forEach((deleteButton) => {
                deleteButton.addEventListener('click', () => {
                    const formId = deleteButton.dataset.formId;
                    const form = document.getElementById(formId);

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: 'Esta acción no se puede deshacer',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Envía el formulario de manera convencional
                            form.submit();
                        } else {
                            Swal.fire('Cancelado', 'La acción ha sido cancelada', 'info');
                        }
                    });
                });
            });
        });
    </script>
