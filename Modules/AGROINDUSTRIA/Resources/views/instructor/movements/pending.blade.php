@extends('agroindustria::layouts.master')
@section('content')
<h3 id="movement_pending">{{trans('agroindustria::menu.Movements Pending')}}</h3>
    <div class="pending">
        @include('agroindustria::instructor.movements.table')
    </div>    
    
@endsection
@section('script')
@endsection