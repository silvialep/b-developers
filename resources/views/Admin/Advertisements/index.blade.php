@extends('layouts.admin')

@section('content')
<div class="container my-3 sponsor">
  <h1>Sponsorizzazioni</h1>

  <div class="cards-container my-5">
    @foreach($adv as $singleAdv)
    <div class="card-outer">
      <div class="card-price">
        <span class="old_price">{{$singleAdv->price + 2}}&euro;</span>
        <span>{{$singleAdv->price}}&euro;</span>
        <span class="small">
          @if($singleAdv->name == 'Standard')
            (24h)
          @elseif($singleAdv->name == 'Gold')
            (72h)
          @else 
            (144h)  
          @endif
        </span>
      </div>
      <div class="card">
        <div class="card-content">
          <div class="card-title">
            <h3>{{$singleAdv->name}}</h3>
          </div>
          <div class="card-body">
            {{$singleAdv->description}}
          </div>
          <div class="button">
            <a href="{{route('payment', $singleAdv->id)}}" class="btn btn-warning">Dettaglio</a>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>

</div>
@endsection