@extends('layouts.admin')

@section('content')

<div class="container mt-3">

    <h1>Il mio profilo</h1>
    <hr>
    <div class="img">
        <img src="..." alt="...">
    </div>
    <hr>
    <h2>{{$developer->user->name}} {{$developer->last_name}}</h2>
    <hr>
    <div class="address"><strong>Indirizzo: </strong>{{$developer->address}}</div>
    <hr>
    <div class="phone"><strong>Telefono: </strong>{{$developer->phone}}</div>
    <hr>
    <div class="services"><strong>Prestazioni: </strong>{{$developer->services}}</div>
    <hr>
    <div class="role"><strong>Titolo: </strong>{{$developer->role}}</div>



</div>




@endsection
