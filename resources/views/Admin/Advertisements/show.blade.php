@extends('layouts.admin')

@section('content')
<div class="container my-3">
  <h1>Sponsor: {{$advertisement->name}}</h1>
  <hr>
  <div class="info">
    <p>{{$advertisement->description}}</p>
    <span>Costo: {{$advertisement->price}}&euro;</span>
  </div>

  <div class="button mt-3">
    <a href="#" class="btn btn-primary">Effettua il pagamento</a>
  </div>
</div>
@endsection