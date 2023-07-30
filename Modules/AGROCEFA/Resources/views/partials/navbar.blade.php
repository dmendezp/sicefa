<div class="navbar d-flex align-items-center">
  <div class="text">
    <a href="#" id="an" style="margin-right: 90px;">AGROCEFA</a>
    
    <a href="{{ route('agrocefa.index') }}" id="an" style="margin-right: 240px;">{{ trans('agrocefa::universal.Home')}}</a>
    <a href="{{ url('lang',['en']) }}" id="an" style="margin-right: 30px;" class="dropdown-item">
      <img src="{{asset('agrocefa/images/general/en.png')}}" alt="" style="width: 16px; height: 16px;"> {{ trans('agrocefa::universal.English')}}
    </a>
    <a href="{{ url('lang',['es']) }}" id="an" class="dropdown-item">
      <img src="{{asset('agrocefa/images/general/es.png')}}" alt="" style="width: 16px; height: 16px;"> {{ trans('agrocefa::universal.Spanish')}}
    </a>
  </div>
</div>
