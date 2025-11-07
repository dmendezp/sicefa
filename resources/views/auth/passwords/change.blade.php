@extends('layouts.app')

@section('content')
<link href="{{ asset('css/login.css') }}" rel="stylesheet">
<div class="container co">
    <div class="card">
        <div class="card-body">
            <a href="{{ route('cefa.welcome') }}"><img src="{{ asset('general/images/Group1.png')}}" width="150px" height="auto" alt=""></a>
            <div class="d-flex">
                <h3 class="font-weight-bold title"> {{ __('Change Password') }}</h3>
            </div>
            <form method="POST" action="{{ route('cefa.password.change') }}">
                @csrf

                
                @if (isset($firstchange))
                <div class="row mb-3">
                    <label for="nickname" class="col-md-4 col-form-label text-md-right">{{ __('Nickname') }}</label>
                    <div class="col-md-6">
                        <input id="nickname" type="text" class="form-control" name="nickname" value="" placeholder="Como quiere llamarse" required >
                    </div>
                </div>
                @endif 
                <div class="row mb-3">
                    <label for="current_password" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

                    <div class="col-md-6">
                        <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" value="" required autocomplete="current-password">
                        @if(Session::get('current_password') && Session::get('current_password') != null)
                        <div style="color:red; font-size:12px">{{ Session::get('current_password') }}</div>
                        @php
                        Session::put('current_password', null)
                        @endphp
                        @endif
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required autocomplete="new-password">
                        @if(Session::get('new_password') && Session::get('new_password') != null)
                        <div style="color:red; font-size:12px">{{ Session::get('new_password') }}</div>
                        @php
                        Session::put('new_password', null)
                        @endphp
                        @endif
                        @error('new_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" required autocomplete="password-confirmation">
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary bt">
                            {{ __('Change Password') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 1500,
            customClass: {
                popup: 'my-custom-popup-class',
            },
        }).then(() => {
            window.location.href = "{{ route('cefa.home') }}";
        });
    });
</script>
@endif
@endsection

