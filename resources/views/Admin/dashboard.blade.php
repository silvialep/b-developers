@extends('layouts.admin')

@section('content')

<div class="container my-3" style="position:relative">

  
  @if(isset($message))
  <div class="alert alert-info alert-dismissible fade show text-center" style="position: absolute; top:0; left:0; right:0; margin: 0 auto;" role="alert">
    {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi"></button>
  </div>
  @endif
  <h2 class="text-center fs-1" style="padding-top:80px;color: rgb(20, 110, 190)">Ciao {{$developer->user->name}} <i class="fa-regular fa-face-grin-beam"></i></h2>

    <div class="row d-flex flex-wrap justify-content-center gap-5" id="dashboard-row">
        <div class="col-12-lg d-flex justify-content-center gap-5 single-row">
            <a href="{{route('admin.profile.show', $developer->id)}}" class="card dashboard-card">
                <img src="{{Vite::asset('resources/img/edit-profile.svg')}}" class="card-img-top" alt="card-image">
                <div class="card-body">
                  <h5 class="card-text">Modifica Profilo</h5>
                </div>
            </a>
        
            <a href="{{route('admin.messages.index')}}" class="card dashboard-card">
                <img src="{{Vite::asset('resources/img/messages.svg')}}" class="card-img-top" alt="card-image">
                <div class="card-body">
                  <h5 class="card-text">Messaggi</h5>
                </div>
            </a>

            <a href="{{route('admin.advertisements.index')}}" class="card dashboard-card">
              <img src="{{Vite::asset('resources/img/sponsor.svg')}}" class="card-img-top" alt="card-image">
              <div class="card-body">
                <h5 class="card-text">Sponsorizzazioni</h5>
              </div>
            </a>
        </div>

        <div class="col-12 d-flex justify-content-center gap-5 single-row">
            <a href="{{route('admin.reviews.index')}}" class="card dashboard-card">
                <img src="{{Vite::asset('resources/img/reviews.svg')}}" class="card-img-top" alt="card-image">
                <div class="card-body">
                  <h5 class="card-text">Recensioni</h5>
                </div>
            </a>
        
            <a href="{{route('admin.statistics')}}" class="card dashboard-card">
              <img src="{{Vite::asset('resources/img/statistic.svg')}}" class="card-img-top" alt="card-image">
              <div class="card-body">
                <h5 class="card-text">Statistiche</h5>
              </div>
            </a>
        </div>

    </div>

    

</div>

@endsection
