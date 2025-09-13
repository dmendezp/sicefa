@extends('evs::layouts.master')

@section('title','Login')

@section('breadcrumb')
<li class="breadcrumb-item active">
  <a href="{{ route('evs.jurados.index') }}"><i class="fas fa-home"></i> Home</a>
</li>
@endsection

@section('content')
<!-- Main content -->
<div class="content">
  <div class="container-fluid">

    <div class="d-flex justify-content-start">
      <div class="p-3 mb-2 bg-info text-dark">
        Jurado:
        {{ optional($person)->first_name ?? '' }}
        {{ optional($person)->first_last_name ?? '' }}
        {{ optional($person)->second_last_name ?? '' }}
      </div>
    </div>

    <div class="row justify-content-md-center">
      <div class="col-md-4">
        <div class="card card-purple card-outline shadow">
          <div class="card-header text-muted border-bottom-0">
            {{-- muestra el nombre de la elección si existe --}}
            {{ $person->juries->first()?->election?->name ?? 'Sin elección asignada' }}
          </div>
          
          <div class="card-body pt-0">
            {{-- Formulario de búsqueda (no hará reload: manejaremos con AJAX) --}}
            {!! Form::open(['url' => route('cefa.evs.juries.search'), 'id' => 'formSearchDocument']) !!}
              @csrf
              <label>Autorizar Votante</label>
              <hr>

              <label for="document_v">Documento:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">
                    <i class="far fa-keyboard"></i>
                  </span>
                </div>
                {!! Form::text('document_v', null, ['class'=>'form-control', 'id'=>'document_v']) !!}
              </div>

              {{-- ocultos: election y jury (vienen del jurado logueado) --}}
              {!! Form::hidden('election', $person->juries->first()?->election?->id ?? '', ['id'=>'election']) !!}
              {!! Form::hidden('jury', session('jury_id') ?? '', ['id'=>'jury']) !!}
              <br>
              {!! Form::button('Buscar', ['class'=>'btn btn-info mtop16', 'id'=>'btnSearchV', 'type'=>'button']) !!}
            {!! Form::close() !!}

            {{-- Aquí se inyectará el resultado de la búsqueda (partial) --}}
            <div id="votante" class="mtop16"></div>

          </div>
        </div>
    
      </div>
    </div>

  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

{{-- JS específico para esta vista --}}

<script>
  (function($){
    // asegúrate que exista token (normalmente lo tiene tu layout)
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') || '{{ csrf_token() }}'
      }
    });

    const searchUrl = "{{ route('cefa.evs.juries.search') }}";
    const authorizedUrl = "{{ route('cefa.evs.juries.authorized') }}";

    // CLICK Buscar -> enviar serialized string como 'data' (compatible con parse_str en controlador)
    $('#btnSearchV').on('click', function(e){
      e.preventDefault();
      const serialized = $('#formSearchDocument').serialize(); // e.g. "document_v=1079...&election=1&jury=3"
      // enviar campo 'data' con la cadena serializada (tu controlador hace parse_str)
      $.post(searchUrl, { data: serialized })
        .done(function(response){
          // response debe ser HTML parcial (view 'evs::jurados.search')
          $('#votante').html(response);

          // después de inyectar el partial, aseguramos que existan los campos election/jury en el partial si hacen falta
          // añadimos hidden con election/jury dentro de #votante para que el autorizar pueda leerlos
          if ($('#votante').find('#v_election').length === 0) {
            const ev = $('#election').val() || '';
            $('#votante').append('<input type="hidden" id="v_election" value="'+ ev +'">');
          }
          if ($('#votante').find('#v_jury').length === 0) {
            const j = $('#jury').val() || '';
            $('#votante').append('<input type="hidden" id="v_jury" value="'+ j +'">');
          }
        })
        .fail(function(xhr){
          console.error('Error en búsqueda', xhr);
          $('#votante').html('<span class="h5 text-danger">Error al buscar. Revisa la consola.</span>');
        });
    });

    // Delegated click para Autorizar (el button viene desde el partial)
    $('#votante').on('click', '#btnAutorized', function(e){
      e.preventDefault();
      const document_v = $('#v_document_v').val() || $('#document_v').val() || '';
      const election = $('#v_election').val() || $('#election').val() || '';
      const jury = $('#v_jury').val() || $('#jury').val() || '';
      const code = $('#v_code').val() || '';

      if (!document_v) {
        alert('Documento vacío.');
        return;
      }

      // Construimos el objeto que tu controlador espera (luego haces json_decode($_POST['data']))
      const payload = {
        document_v: document_v,
        election: election,
        jury: jury,
        code: code
      };

      // enviamos como campo 'data' con JSON string -> compatible con json_decode($_POST['data'])
      $.post(authorizedUrl, { data: JSON.stringify(payload) })
        .done(function(res){
          // res puede ser mensaje de éxito o error HTML
          $('#votante').html(res);
        })
        .fail(function(xhr){
          console.error('Error en autorización', xhr);
          $('#votante').html('<span class="h5 text-danger">Error al autorizar. Revisa la consola.</span>');
        });
    });

  })(jQuery);
</script>


@stop
