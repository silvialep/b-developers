@extends('layouts.admin')

@section('content')
<div class="container my-3">
  <h1>Sponsor: {{$advertisement->name}}</h1>
  <hr>
  <div class="info">
    <p>{{$advertisement->description}}</p>
    <span>Costo: {{$advertisement->price}}&euro;</span>
  </div>


  @if (count($active_adv)>0)
  <div class="w-50">
    <p class="alert alert-danger my-3">Finchè avrai delle sponsorizzazioni in corso non potrai acquistarne altre</p>
    @else 

    <form method="POST" action="{{ route('adv_dev', $advertisement) }}" id="payment-form">
      @csrf
      {{-- <div id="dropin-container"></div> --}}
        <div class="col-md-6">
            <script src="https://js.braintreegateway.com/web/dropin/1.34.0/js/dropin.min.js"
              data-braintree-dropin-authorization="{{ $clientToken }}"></script>
            <div id="checkout-message"></div>
  
            <a href="{{route('admin.advertisements.index')}}" class="btn btn-dark me-2 py-2"><i class="fa-solid fa-arrow-left"></i> Torna indietro</a>
            <button id="submit-button" class="bn632-hover bn26">Paga adesso</button>
        </div>
        <input type="hidden" name="advertisement_id" value="{{ $advertisement->id }}">
        {{-- <button type="submit" id="submit-button" class="button btn py-2 px-3 button--small button--green">Acquista</button> --}}
    </form>
      
  </div>
  @endif
</div>


@endsection

@section('scripts')
  <script>
      const form = document.querySelector('#payment-form');
      const container = document.getElementById('dropin-container');
      let client_token = "{{ $clientToken }}";
      const submitButton = document.querySelector('#submit-button');

      braintree.dropin.create({
          authorization: client_token,
          selector: '#dropin-container',
          venmo: {}, paypal: {flow: 'vault'}, paypalCredit: {flow: 'vault'},
          }, function (err, instance) {
          button.addEventListener('click', function () {
              instance.requestPaymentMethod(function (err, payload) {
              });
          })
          });
  </script>
@endsection

{{-- 
  <script src="https://js.braintreegateway.com/web/dropin/1.36.0/js/dropin.js"></script>

  <div id="dropin-container"></div>
  <form method="POST" action="{{ route('adv_dev') }}">
      @csrf
      <input type="hidden" name="advertisement_id" value="{{ $advertisement->id }}">
      <a href="{{route('admin.advertisements.index')}}" class="btn btn-dark me-2 py-2"><i class="fa-solid fa-arrow-left"></i> Torna indietro</a>
      <button type="submit" id="submit-button" class="button btn py-2 px-3 button--small button--green">Acquista</button>
  </form>
</div>
@endsection --}}