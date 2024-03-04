@extends('layouts.main')

@section('title', 'Autoavaluació Alumnes')

@section('content')
   <autoavaluacio-profe :usuari="{{ Auth::user()}}" :accesstoken="{{ json_encode($token) }}"></autoavaluacio-profe>
@endsection