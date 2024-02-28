@extends('layouts.main')

@section('Modifica la contrasenya')

@section('content')

    <div class="container-fluid">
        <div class="row ps-4 pe-4 mt-3">
            @include('partials.mensajes')

            <div class="card">
                <div class="card-body">
                    <h2 class="card-title mb-4">{{$usuari->nom . ' ' . $usuari->cognom}}</h2>
                    <form action="{{ action([App\Http\Controllers\UsuariController::class, 'updatePassword'], ['usuari' => $usuari->id])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="old_password" class="form-label">Old Password</label>
                            <input type="password" class="form-control" id="old_password" name="old_password">
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

@endsection