<?php
// funzioni per creare le stelle intere e le metà per i voti dell'utente 

function fullStar($ratingsAvg) {
  return $fullStar = floor($ratingsAvg); 
};


function halfStar($ratingsAvg) {
  return $halfStar = floor($ratingsAvg * 2) / 2 - fullStar($ratingsAvg);
};


function remainingStar ($ratingsAvg) {
  return $remainingStar =  5 - ( fullStar($ratingsAvg) + round(halfStar($ratingsAvg)) );
}

//////

?>


@extends('layouts.admin')

@section('content')



<div class="container mt-3 profile-show">

    <h1>Il mio profilo</h1>
    <hr>
    <div class="img">
        <img id="profile-pic" src="{{asset('storage/' . $developer->picture)}}" alt="profile-picture">
    </div>
    <h2>{{$developer->user->name}} {{$developer->last_name}} </h2>  @for($i=0; $i < fullStar($ratingsAvg); $i++)  <i class="fa-solid fa-star"></i> @endfor @for($i=0; $i < halfStar($ratingsAvg); $i++)  <i class="fa-solid fa-star-half-stroke"></i> @endfor   @for($i=0; $i < remainingStar($ratingsAvg); $i++) <i class="fa-regular fa-star"></i> @endfor <small> ( {{$ratingsNumber}} ) </small>
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
      <strong>Specializzazioni</strong>
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
        
        <span>{{$currentAdv}}</span>
        
      </div>
    </div>


    <div class="buttons mt-3">
        <a href="{{route('admin.profile.edit', $developer)}}" class="btn btn-primary">Modifica</a>
    </div>
</div>



@endsection
