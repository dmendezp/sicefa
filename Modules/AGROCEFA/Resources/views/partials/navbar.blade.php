<div class="navbar d-flex align-items-center">
  <div class="text">
    <a href="#" id="an" style="margin-right: 70px;">AGROCEFA</a>
    <a href="{{ route('agrocefa.aprendiz')}}" id="an" style="margin-right: 20px;">Aprendiz</a>
    <a href="{{ route('agrocefa.user')}}" id="an" style="margin-right: 40px;">Usuario</a>
    <a href="{{ route('agrocefa.parameters')}}" id="an" style="margin-right: 30px;">{{ trans('agrocefa::universal.Parameters')}}</a>
    <a href="{{ route('agrocefa.index') }}" id="an" style="margin-right: 70px;">{{ trans('agrocefa::universal.Home')}}</a>
    <a href="{{ url('lang',['en']) }}" id="an" style="margin-right: 30px;" class="dropdown-item">
      <img src="{{asset('agrocefa/images/general/en.png')}}" alt="" style="width: 16px; height: 16px;"> {{ trans('agrocefa::universal.English')}}
    </a>
    <a href="{{ url('lang',['es']) }}" id="an" class="dropdown-item">
      <img src="{{asset('agrocefa/images/general/es.png')}}" alt="" style="width: 16px; height: 16px;"> {{ trans('agrocefa::universal.Spanish')}}
    </a>
  </div>
</div>
