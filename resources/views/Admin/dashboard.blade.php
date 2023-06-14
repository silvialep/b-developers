@extends('layouts.admin')

@section('content')

<div class="container mt-3">

    <div class="row d-flex flex-wrap justify-content-center gap-5" id="dashboard-row">
        <div class="col-12 d-flex justify-content-center gap-5">
            <a href="#" class="card dashboard-card" style="width: 18rem;">
                <img src="{{Vite::asset('resources/img/edit-profile.svg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-text">Edit Profile</h5>
                </div>
            </a>
        
            <a href="#" class="card dashboard-card" style="width: 18rem;">
                <img src="{{Vite::asset('resources/img/messages.svg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-text">My messages</h5>
                </div>
            </a>
        </div>

        <div class="col-12 d-flex justify-content-center gap-5">
            <a href="#" class="card dashboard-card" style="width: 18rem;">
                <img src="{{Vite::asset('resources/img/reviews.svg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-text">My Reviews</h5>
                </div>
            </a>
        
              <a href="#" class="card dashboard-card" style="width: 18rem;">
                <img src="{{Vite::asset('resources/img/statistic.svg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-text">Statistics</h5>
                </div>
            </a>
        </div>

    </div>
    

    

</div>

@endsection
