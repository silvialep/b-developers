@extends('layouts.admin')

@section('content')

<div id="notfound-container">
    <img id="notfound-robot" src="{{Vite::asset('resources/img/notfound.svg')}}" alt="">
</div>

<div class="container alert alert-danger text-center">

    <h2>Pagina non trovata</h2>
    
</div>

@endsection