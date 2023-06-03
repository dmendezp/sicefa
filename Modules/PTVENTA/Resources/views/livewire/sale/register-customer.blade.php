<div>
    <!-- Modal -->
    <div class="modal fade" id="registerCustomer" tabindex="-1" aria-labelledby="registerCustomerLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header py-2">
                        <h1 class="modal-title fs-5" id="registerCustomerLabel">Registro de cliente</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Identificación</label>
                            <div class="row">
                                <div class="col-6 pe-1">
                                    {{ Form::select('document_type', $document_types, null, [
                                        'class' => 'form-select form-select-sm',
                                        'wire:model.defer' => 'document_type',
                                        'required'])
                                    }}
                                </div>
                                <div class="col-6 ps-1">
                                    {{ Form::number('document_number', null, [
                                        'class' => 'form-control form-control-sm',
                                        'placeholder' => 'Número',
                                        'wire:model.defer' => 'document_number',
                                        'required'])
                                    }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nombres</label>
                            {{ Form::text('first_name', null, [
                                'class' => 'form-control form-control-sm',
                                'placeholder' => 'Primer y segundo nombre',
                                'wire:model.defer' => 'first_name',
                                'required'])
                            }}
                        </div>
                        <div class="form-group">
                            <label>Apellidos</label>
                            <div class="row">
                                <div class="col-6">
                                    {{ Form::text('first_last_name', null, [
                                        'class' => 'form-control form-control-sm',
                                        'placeholder' => 'Primer apellido',
                                        'wire:model.defer' => 'first_last_name',
                                        'required'])
                                    }}
                                </div>
                                <div class="col-6">
                                    {{ Form::text('second_last_name', null, [
                                        'class' => 'form-control form-control-sm',
                                        'placeholder' => 'Segundo apellido',
                                        'wire:model.defer' => 'second_last_name',
                                        'required'])
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary py-0" data-bs-dismiss="modal" wire:click="closeModal">Cancelar</button>
                        <button type="submit" class="btn btn-sm btn-success py-0">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    {{-- Verificar el estado del modal para saber si debe estar abierto o cerrado --}}
    @if ($modal_state)
        <script>
            $('#registerCustomer').modal('show');
        </script>
    @endif
</div>
