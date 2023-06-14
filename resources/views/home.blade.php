@extends('layouts.app')
@section('content')

    <div class="container mt-4">

        <h1>Homepage</h1>

        <div class="d-flex flex-wrap gap-3">

            @foreach ($developers as $developer)
            <div class="card" style="width: 18rem;">
                <img id="profile-pic" class="card-img-top" src="{{asset('storage/' . $developer->picture)}}" alt="profile-picture">
                <div class="card-body p-0 d-flex flex-column">
                  <h5 class="card-title px-3">{{$developer->user?->name}} {{$developer->last_name}}</h5>
                  <hr>
                  <div class="card-text px-3 flex-grow-1">
                    <div class="address mt-1"><strong>Indirizzo: </strong>{{$developer->address}}</div>
                    <div class="phone mt-1"><strong>Telefono: </strong>{{$developer->phone}}</div>
                    <div class="role mt-1"><strong>Titolo: </strong>{{$developer->role}}</div>
                    <div class="services mt-1"><strong>Prestazioni: </strong>{{$developer->services}}</div>
                  </div>
                  <a href="{{route('developer.show', $developer)}}" class="btn btn-primary mt-2 m-3 w-50 align-self-center">Dettaglio</a>
                </div>
              </div>
            @endforeach
        </div>

    </div>
@endsection