@extends('layouts.admin')

@section('content')

<div class="container mt-3">

  @if(isset($message))
  <div class="alert alert-info alert-dismissible fade show" role="alert">
    {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi"></button>
  </div>
  @endif

    <div class="row d-flex flex-wrap justify-content-center gap-5" id="dashboard-row">
        <div class="col-12 d-flex justify-content-center gap-5">
            <a href="{{route('admin.profile.show', $developer->id)}}" class="card dashboard-card" style="width: 18rem;">
                <img src="{{Vite::asset('resources/img/edit-profile.svg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-text">Modifica Profilo</h5>
                </div>
            </a>
        
            <a href="{{route('admin.messages.index')}}" class="card dashboard-card" style="width: 18rem;">
                <img src="{{Vite::asset('resources/img/messages.svg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-text">Messaggi</h5>
                </div>
            </a>

            <a href="{{route('admin.advertisements.index')}}" class="card dashboard-card" style="width: 18rem;">
              <img src="{{Vite::asset('resources/img/sponsor.svg')}}" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-text">Sponsorizzazioni</h5>
              </div>
            </a>
        </div>

        <div class="col-12 d-flex justify-content-center gap-5">
            <a href="{{route('admin.reviews.index')}}" class="card dashboard-card" style="width: 18rem;">
                <img src="{{Vite::asset('resources/img/reviews.svg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-text">Recensioni</h5>
                </div>
            </a>
        
            <a href="{{route('admin.statistics')}}" class="card dashboard-card" style="width: 18rem;">
              <img src="{{Vite::asset('resources/img/statistic.svg')}}" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-text">Statistiche</h5>
              </div>
            </a>
        </div>

    </div>

    

</div>

@endsection
