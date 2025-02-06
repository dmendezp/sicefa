<div id="content-monitoring">
    <div class="modal-header py-2">
        <h4 class="modal-title" id="exampleModalLabel">
            <b>{{ $titleView }}</b>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body px-4">
        <h5 class="text-center">
            <b>{{ $study->producer->name }}</b> ( {{ $study->village->VillMun }} )
        </h5>
        <ul class="row bg-light">
            <li class="col-4">
                <b>{{ trans('cpd::monitoring.F_Text_Monitoring') }} </b> {{ $study->monitoring }}
            </li>
            <li class="col-4">
                <b>{{ trans('cpd::monitoring.F_Text_Typology') }} </b> {{ $study->typology }}
            </li>
            <li class="col-4">
                <b>{{ trans('cpd::monitoring.F_Text_Altitude') }} </b> {{ $study->altitud }}
            </li>
        </ul>
        @foreach ($datas as $data)
            <b style="font-size: 17px;">
                {{ $data->name }}
            </b>
            <ul class="row bg-light">
                @if ($data->metadatas->count())
                    @foreach ($data->metadatas as $metadata)
                        @php $ab = $metadata->abbreviation; @endphp
                        <li class="col-3" data-toggle='tooltip' data-placement="top" title="{{ $metadata->description }}">
                            <b>{{ $ab }}: </b> {{ $study->$ab }} <i style="font-size: small;">{{ $metadata->unit_measure }}</i>
                        </li>
                    @endforeach
                @endif
            </ul>
        @endforeach
    </div>
    <div class="modal-footer py-1">
        <button type="button" class="btn btn-secondary btn-md py-0" data-dismiss="modal">{{ trans('cpd::monitoring.Btn_Close') }}</button>
        {!! Form::open(['route'=>'cpd.admin.study.destroy', 'method'=>'POST', 'id'=>'form-study']) !!}
            {!! Form::hidden('study_id', $study->id) !!}
            {!! Form::submit(trans('cpd::monitoring.Btn_Delete'), ['class'=>'btn btn-danger btn-md py-0']) !!}
        {!! Form::close() !!}
    </div>
</div>

<script type="text/javascript">
	$(function () {
  		$('[data-toggle="tooltip"]').tooltip()
	})

    $('#form-study').submit(function () { /* Effect for status sending information */
        $('#loader-message').text('Eliminando información...'); /* Add content to loader */
        $("#content-monitoring").hide(); /* Hide the content of the modal */
        $('#modal-content').append($('#modal-loader').clone()); /* Add the loader to the modal */
    });
</script>
