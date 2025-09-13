{{-- Vista parcial que devuelve el controlador search --}}
<div class="found-voter">
  <label class="h5">
    {{ $person->first_name ?? '' }} {{ $person->first_last_name ?? '' }} {{ $person->second_last_name ?? '' }}
  </label>

  <div class="mt-2">
    <span>Código de seguridad:</span>

    @php
      // generamos código numérico de 6 dígitos en servidor (compatible con tu controller)
      $permitted_chars = '0123456789';
      $code = substr(str_shuffle($permitted_chars), 0, 6);
    @endphp

    <h4>{{ $code }}</h4>

    {{-- hidden con documento y code para que JS los lea luego --}}
    <input type="hidden" id="v_document_v" value="{{ $person->document_number ?? '' }}">
    <input type="hidden" id="v_code" value="{{ $code }}">

    {{-- El botón es capturado por JS en la vista principal via delegated event --}}
    <button class="btn btn-success mtop16" id="btnAutorized" type="button">Autorizar</button>
  </div>
</div>
