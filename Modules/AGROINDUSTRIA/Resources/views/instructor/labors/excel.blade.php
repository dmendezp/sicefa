<!-- Modal Aprobar-->
<div class="modal fade" id="excel" tabindex="-1" aria-labelledby="excelLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="excelLabel">Imprimir formato de solicitud de bienes</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <p id="delete_receipe">¿{{trans('agroindustria::formulations.You want to remove the recipe from')}}?</p>
            </div>                
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">{{trans('agroindustria::formulations.Delete')}}</button>
        </div>
      </div>
    </div>
  </div>