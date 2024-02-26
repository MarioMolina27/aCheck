@extends('layouts.main')

@section('title', 'Login')

@section('content')
    <div class="container-fluid mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-8 card-custom">
                <div class="row">
                    <div class="col-md-6 ps-0 pe-0">
                        <img src="./img/loginPhoto.jpeg" alt="" class="img-fluid image-login" style="">
                    </div>
                    <div class="col-md-6">
                        <h2 class="mb-4 mt-3 login-title">Iniciar sesión</h2>
                        <form method="POST" action='{{ action([App\Http\Controllers\UsuariController::class, 'login']) }}'>
                            @csrf
                            <div class="form-floating mb-3">
                                <input id="email" type="email" name='username'
                                       class="form-control @error('username') is-invalid @enderror"
                                       value="{{ old('username') }}" required autocomplete="email" autofocus>
                                <label for="email">Email</label>
                                @error('username')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input id="password" type="password" name="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       required>
                                <label for="password">Contrasenya</label>
                                @error('password')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary w-100 fw-bold">
                                    Login
                                </button>
                            </div>
                            <div class="mt-5">
                                <p class="w-100">
                                    No tienes cuenta? <a class="fw-bold">Regístrate</a>
                                </p>
                            </div>     
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
