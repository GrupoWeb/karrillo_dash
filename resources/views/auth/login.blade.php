@extends('layouts.loginApp')

@section('title')
    Karrillo
@endsection

@section('content')

            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="{{asset('img/logo.jpg')}}" class="brand_logo shadow" alt="Logo">
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group mb-3 col-md-12">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
{{--                            <div class="col-md-12">--}}
                                <input id="email" type="text" class="form-control input_user @error('email') is-invalid @enderror"  placeholder="{{ __('Correo Electrónico') }}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
{{--                            </div>--}}
                        </div>
                        <div class="input-group mb-3 col-md-12">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
{{--                            <div class="col-md-12">--}}
                                <input id="password" type="password" placeholder="{{ __('Password') }}" class="form-control @error('Contraseña') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
{{--                            </div>--}}
                        </div>

                        <div class="d-flex justify-content-center mt-5 ">
                            <button type="submit" name="button" class="btn btn-danger btn-lg btn-block">Entrar</button>
                        </div>
                    </form>
                </div>
            </div>

@endsection
