<!-- ======= Services Section ======= -->
    <section id="modules" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Aplicaciones</h2>
          <p>Soluciones de software para nuestro centro</p>
        </div>

        {{-- @foreach(getAppsArray() as $cod => $app)                    
                    <div class="puzzle" style="background-image:url('{{ asset('/general/images/puzzle'.$loop->iteration.'.png') }}');">
                    <span class="t" style="background-color: {{ getColorsArray($cod) }}"></span>
                    <span class="r" style="background-color: {{ getColorsArray($cod) }}"></span>
                    <span class="text"><a href="{{ getURLAppsArray($cod) }}"><i class="{{ getIconsArray($cod) }}" data-toggle="tooltip" data-placement="top" title="{{ $app }}"></i></a></span>
                    </div>
                  @endforeach  --}}

        <div class="row">

          @foreach($apps as $app)
          <style type="text/css">
              .services .icon-box:hover .colorapp{{ $app->id }} {
                color: {{ $app->color }} !important;
              }

          </style>
          <div class="col-xl-3 col-md-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100" style="padding: 1%;">
            <div class="icon-box">
              <div class="icon">
              <h4><a class="colorapp{{ $app->id }}" href="{{ url($app->url) }}"><i class="colorapp{{ $app->id }} {{ $app->icon }}"></i> {{ $app->name }}</a></h4></div>
              <p>
                @if(session('lang')=='en')
                  {{ $app->description_english }}
                @else
                  {{ $app->description }}                
                @endif
              </p>
            </div>
          </div>
          @endforeach          

        </div>

      </div>
    </section><!-- End Services Section -->