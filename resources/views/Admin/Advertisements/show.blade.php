@extends('layouts.admin')

@section('content')
<div class="container my-3">
  <h1>Sponsor: {{$advertisement->name}}</h1>
  <hr>
  <div class="info">
    <p>{{$advertisement->description}}</p>
    <span>Costo: {{$advertisement->price}}&euro;</span>
  </div>

  <script src="https://js.braintreegateway.com/web/dropin/1.36.0/js/dropin.js"></script>

  <div id="dropin-container"></div>
  <form method="POST" action="{{ route('adv_dev') }}">
      @csrf
      <input type="hidden" name="advertisement_id" value="{{ $advertisement->id }}">
      <a href="{{route('admin.advertisements.index')}}" class="btn btn-dark me-2 py-2"><i class="fa-solid fa-arrow-left"></i> Torna indietro</a>
      <button type="submit" id="submit-button" class="button btn py-2 px-3 button--small button--green">Acquista</button>
  </form>
</div>
@endsection