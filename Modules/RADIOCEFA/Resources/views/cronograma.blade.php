@extends('radiocefa::layouts.master')

@section('styles')

@endsection

 @section('textHero')
  <h1>Cronograma</h1>
  <h2><p>Programate en tu dia con nuestras secciones</p></h2>
@endsection
@include('radiocefa::layouts/partials/hero')

@include('radiocefa::layouts/partials/navbar')

@section('content')
<div class="m-4">
  <table class="table table-bordered text-center">
    <tr id="fecha">
      <th>dd/mm/aaaa</th>
      <th>dd/mm/aaaa</th>
      <th>dd/mm/aaaa</th>
      <th>dd/mm/aaaa</th>
      
    </tr>
    <tr>
      <td>8:00</td>
      <td class="bg-dark">
        <div class="">
          <B><h2>Radiocefa</h2></B>
          <p>Musica para ti</p>
        </div>
      </td>
      <td class="bg-dark">
        <div class="">
          <B><h2>Radiocefa</h2></B>
          <p>Musica para ti</p>
        </div>
      </td>
      <td class="bg-dark">
        <div class="">
          <B><h2>Radiocefa</h2></B>
          <p>Musica para ti</p>
        </div>
      </td>
      <td class="bg-dark">
        <div class="">
          <B><h2>Radiocefa</h2></B>
          <p>Musica para ti</p>
        </div>
      </td>
    </tr>
    {{-- FILA 2  ..........--}}
    <tr>
      <td>9:00 AM</td>
      <td class="bg-dark">
        <div class="">
          <B><h2>Radiocefa</h2></B>
          <p>Musica para ti</p>
        </div>
      </td>
      <td class="bg-dark">
        <div class="">
          <B><h2>Radiocefa</h2></B>
          <p>Musica para ti</p>
        </div>
      </td>
      <td class="bg-dark">
        <div class="">
          <B><h2>Radiocefa</h2></B>
          <p>Musica para ti</p>
        </div>
      </td>
      <td class="bg-dark">
        <div class="">
          <B><h2>Radiocefa</h2></B>
          <p>Musica para ti</p>
        </div>
      </td>
    </tr>
  </table>  
</div>


@include('radiocefa::layouts/partials/script')

@include('radiocefa::layouts/partials/footer')

@endsection