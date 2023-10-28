<div class="modal" id="myModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="vacancyTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header"><strong>
                                {{ trans('senaempresa::menu.General Description') }}:
                        </div></strong>
                        <p id="vacancyDescription"></p>
                        <div class="card-header"><strong>
                                {{ trans('senaempresa::menu.Requirements') }}:
                        </div></strong>
                        <ul id="vacancyRequirements" class="list-unstyled">
                        </ul>
                        <div class="card-header">
                            <strong>{{ trans('senaempresa::menu.Start Date and Time') }}</strong>
                        </div>
                        <p> <span id="vacancyStartDate"></span></p>
                        <div class="card-header">
                            <strong>{{ trans('senaempresa::menu.Date and Time End') }}</strong>
                        </div>
                        <p> <span id="vacancyEndDate"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
