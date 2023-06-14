@extends('layouts.admin')

@section('content')

<div class="container mt-3">

    <form action="{{route('admin.profile.update', $developer)}}" method="POST">

        @csrf
        
        @method('PUT')

        <div class="mb-3">
            <label class="fw-bold" for="last_name">Cognome</label>
            <input class="form-control @error('last_name') is-invalid @enderror" type="text" id="last_name" name="last_name" value="{{old('last_name') ?? $developer->last_name}}">
            
            @error('last_name')
              <div class="invalid-feedback">
                {{$message}}
              </div> 
            @enderror
    
        </div>

        <div class="mb-3">
            <label class="fw-bold" for="role">Titolo</label>
            <input class="form-control @error('role') is-invalid @enderror" type="text" id="role" name="role" value="{{old('role') ?? $developer->role}}">
            
            @error('role')
              <div class="invalid-feedback">
                {{$message}}
              </div> 
            @enderror
    
        </div>

        <div class="mb-3">
            <label class="fw-bold" for="address">Indirizzo</label>
            <input class="form-control @error('address') is-invalid @enderror" type="text" id="address" name="address" value="{{old('address') ?? $developer->address}}">
            
            @error('address')
              <div class="invalid-feedback">
                {{$message}}
              </div> 
            @enderror
    
        </div>

        <div class="mb-3">
            <label class="fw-bold" for="phone">Telefono</label>
            <input class="form-control @error('phone') is-invalid @enderror" type="text" id="phone" name="phone" value="{{old('phone') ?? $developer->phone}}">
            
            @error('phone')
              <div class="invalid-feedback">
                {{$message}}
              </div> 
            @enderror
    
        </div>

        <div class="mb-3">
            <label class="fw-bold" for="services">Prestazioni</label>
            <textarea class="form-control @error('services') is-invalid @enderror" id="services" name="services">{{old('services') ?? $developer->services}}</textarea>
    
              @error('services')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
              @enderror
    
        </div>

        <button class="btn btn-primary" type="submit">Salva</button>


    </form>

</div>

@endsection
