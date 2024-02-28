@extends('layouts.main')

@section('title', 'Usuaris')

@section('content')

    <div class="container-fluid mt-4">
        <nav aria-label="breadcrumb mb-5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dades Mestres</a></li>
                <li class="breadcrumb-item active" aria-current="page">Usuaris</li>
            </ol>
        </nav>
    </div>

    <div class="container-fluid">
        <div class="row ps-4 pe-4 mt-3">
            @include('partials.mensajes')
        </div>

        <div class="row">
            <form action="{{ route('usuaris.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" name="nombre" class="form-control" placeholder="Francisco, Pol, David, Mario..."
                        aria-label="Username" aria-describedby="basic-addon1" value="{{ old('nombre') }}">

                    <select name="tipo" class="form-select" aria-label="Default select example">
                        <option value="all" {{ old('tipo') == 'all' ? 'selected' : '' }}>All</option>
                        @foreach ($tipus_usuaris as $tipusUsuari)
                            <option value="{{ $tipusUsuari->id }}" {{ old('tipo') == $tipusUsuari->id ? 'selected' : '' }}>
                                {{ $tipusUsuari->tipus }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>

        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Nom Usuari</th>
                    <th>Correu</th>
                    <th>Tipus</th>
                    <th>Actiu</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuaris as $usuari)
                    <tr>
                        <td>{{ $usuari->id }}</td>
                        <td>{{ $usuari->nom }}</td>
                        <td>{{ $usuari->nom_usuari }}</td>
                        <td>{{ $usuari->correu }}</td>
                        <td>{{ $usuari->tipusUsuari->tipus }}</td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $usuari->actiu }}"
                                    id="actiu{{ $usuari->id }}" {{ $usuari->actiu ? 'checked' : '' }}
                                    @disabled(true)>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-lg-4 col-12">
                                    <a href="{{ route('usuaris.editPassword', $usuari->id) }}" class="btn btn-warning" href=""><i class="fa-solid fa-key"></i></a>
                                </div>
                            <div class="col-lg-4 col-12">
                                <a href="{{ route('usuaris.edit', $usuari->id) }}" class="btn btn-info"><i
                                    class="fas fa-edit"></i></a>
                            </div>
                            <div class="col-lg-4 col-12">
                                <form action="{{ route('usuaris.destroy', $usuari->id) }}" method="POST"
                                    class="deleteForm-{{ $usuari->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <delete-button :form-id="'deleteForm-{{ $usuari->id }}'"></delete-button>
                                </form>
                            </div>
                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                {{ $usuaris->links() }}
            </div>
            <div class="col-12 col-md-6 col-lg-6 d-flex justify-content-end align-items-center">
                <a href="{{ route('usuaris.create') }}" class="btn btn-primary btn-lg me-4">Create</a>
            </div>
        </div>
    </div>
@endsection
