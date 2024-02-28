@extends('layouts.main')

@section('title', isset($usuari) ? 'Edit User' : 'Create New User')

@section('content')

    <div class="container-fluid">
        <div class="row mt-3">
            @include('partials.mensajes')
        </div>
        <div class="row">
            <div class="col-12 mb-3 mb-sm-0 mt-3">
                <div class="card mb-3">
                    <div class="card-body">
                        <form
                            @if (!isset($usuari)) action="{{ action([App\Http\Controllers\UsuariController::class, 'store']) }}"  
                            @else action="{{ action([App\Http\Controllers\UsuariController::class, 'update'], ['usuari' => $usuari->id]) }}" @endif
                            method="POST" id="formInfo">
                            @csrf
                            @if (isset($usuari))
                                @method('PUT')
                            @endif
                            <h2 class="card-title mb-4">{{ isset($usuari) ? 'Edit User' : 'Create New User' }}</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="username" name="username"
                                                placeholder="User" required
                                                value="{{ isset($usuari) ? $usuari->nom_usuari : old('username') }}">
                                            <label for="username">Nom Usuari</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Mario" required
                                                value="{{ isset($usuari) ? $usuari->nom : old('name') }}">
                                            <label for="name">Nom</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="surname" name="surname"
                                                placeholder="Molina" required
                                                value="{{ isset($usuari) ? $usuari->cognom : old('surname') }}">
                                            <label for="surname">Cognoms</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" placeholder="name@example.com"
                                                name="email" id="email" required
                                                value="{{ isset($usuari) ? $usuari->correu : old('email') }}">
                                            <label for="email">Email</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        @php
                                            $disabled = isset($usuari) ? 'disabled' : '';
                                        @endphp
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Password" {{ $disabled }}
                                                {{ isset($usuari) ? '' : 'required' }}>
                                            <label for="password">Contrasenya</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="password2" name="password2"
                                                placeholder="Password" {{ $disabled }}
                                                {{ isset($usuari) ? '' : 'required' }}>
                                            <label for="password2">Repeteix la contrasenya</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <select class="form-select" id="tipusUsuari" name="tipusUsuari"
                                                aria-label="Floating label select example">
                                                @foreach ($tipus_usuaris as $tipusUsuari)
                                                    <option value="{{ $tipusUsuari->id }}"
                                                        {{ isset($usuari) ? ($usuari->tipus_usuaris_id == $tipusUsuari->id ? 'selected' : '') : (old('tipo') == $tipusUsuari->id ? 'selected' : '') }}>
                                                        {{ $tipusUsuari->tipus }}</option>
                                                @endforeach
                                            </select>
                                            <label for="tipusUsuari">Rol</label>
                                        </div>

                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" id="actiu" name="actiu"
                                                {{ isset($usuari) ? ($usuari->actiu ? 'checked' : '') : (old('actiu') == 'on' ? 'checked' : '') }}>
                                            <label class="form-check-label" for="actiu">
                                                Actiu
                                            </label>
                                        </div>
                                    </div>
                                </div>
                               
                                @php
                                    $modulsMatriculats = isset($modulsMatriculats) ? $modulsMatriculats : [];
                                    $cicleUsuari = isset($cicleUsuari) ? $cicleUsuari : '';
                                @endphp
                                
                                <moduls-checkbox :modules_selected='@json($modulsMatriculats)' :modules='@json($modules)' :cicles='@json($cicles)' :cicle='@json($cicleUsuari)'></moduls-checkbox>
                                
                                <div class="row mt-4">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary btn-lg">Guardar</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
