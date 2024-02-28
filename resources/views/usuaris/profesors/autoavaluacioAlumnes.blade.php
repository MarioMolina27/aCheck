@extends('layouts.main')

@section('title', 'Autoavaluació Alumnes')

@section('content')
   <autoavaluacio-profe :usuari="{{ Auth::user()}}"></autoavaluacio-profe>
@endsection