@extends('layouts.admin')

@section('content')

<div class="container mt-3">

    <h1>Il mio profilo</h1>
    <hr>
    <div class="img">
        <img id="profile-pic" src="{{asset('storage/' . $developer->picture)}}" alt="profile-picture">
    </div>
    <h2>{{$developer->user->name}} {{$developer->last_name}}</h2>
    <hr>
    <div class="address"><strong>Indirizzo: </strong>{{$developer->address}}</div>
    <hr>
    <div class="phone"><strong>Telefono: </strong>{{$developer->phone}}</div>
    <hr>
    <div class="services"><strong>Prestazioni: </strong>{{$developer->services}}</div>
    <hr>
    <div class="role"><strong>Titolo: </strong>{{$developer->role}}</div>
    <hr>
    <div class="skills">
      <strong>Skills</strong>
        <ul>
            @foreach($developer->skills as $skill)
              <li>{{$skill->name}}</li>
            @endforeach
        </ul>
    </div>
    <hr>
    <strong>Curriculum</strong>
    <div class="img my-3">
        <img id="cv-pic" src="{{asset('storage/' . $developer->cv)}}" alt="profile-cv">
    </div>
    <hr>
    <div class="adv">
      <strong>Sponsorizzazione</strong>
      <div>
        @if(count($developer->advertisements)>0)
          @foreach($developer->advertisements as $adv)
            <span>{{$adv->name}}</span>
          @endforeach
        @else
          <span>Profilo non sponsorizzato.</span>
        @endif
      </div>
    </div>


    <div class="buttons mt-3">
        <a href="{{route('admin.profile.edit', $developer)}}" class="btn btn-primary">Modifica</a>
    </div>
</div>



@endsection
