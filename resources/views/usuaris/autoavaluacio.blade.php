@extends('layouts.main')

@section('title', 'Autoavaluació')

@section('content')
    <autoavaluacio usuari = '@json(Auth::user())'></autoavaluacio>
@endsection