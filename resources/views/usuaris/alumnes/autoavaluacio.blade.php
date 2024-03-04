@extends('layouts.main')

@section('title', 'Autoavaluació')

@section('content')
    <autoavaluacio :usuari="{{ Auth::user() }}" :accesstoken="{{ json_encode($token) }}"></autoavaluacio>
@endsection