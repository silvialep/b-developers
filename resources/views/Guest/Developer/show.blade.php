@extends('layouts.app')

@section('content')

    <div class="container mt-4">

        <h1>Dettaglio Sviluppatore</h1>
        <div class="img">
            <img id="profile-pic" src="{{asset('storage/' . $developer->picture)}}" alt="profile-picture">
        </div>
        <h3>{{$developer->user->name}} {{$developer->last_name}}</h3>
        <hr>
        <div class="address mt-1"><strong>Indirizzo: </strong>{{$developer->address}}</div>
        <div class="phone mt-1"><strong>Telefono: </strong>{{$developer->phone}}</div>
        <div class="role mt-1"><strong>Titolo: </strong>{{$developer->role}}</div>
        <div class="services mt-1"><strong>Prestazioni: </strong>{{$developer->services}}</div>
        <div class="skills">
          <strong>Skills</strong>
          <ul>
              @foreach($developer->skills as $skill)
                  <li>{{$skill->name}}</li>
              @endforeach
          </ul>
        </div>

    </div>
@endsection