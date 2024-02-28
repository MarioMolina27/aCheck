@extends('layouts.main')

@section('title', 'Autoavaluació')

@section('content')
    <autoavaluacio :usuari="{{ Auth::user()}}"></autoavaluacio>
@endsection