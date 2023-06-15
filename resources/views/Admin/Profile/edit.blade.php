@extends('layouts.admin')

@section('content')

<script>
  // checkbox validation
  function handleData(){ 
    const form_data = new FormData(document.querySelector("form"));
    const checkbox = document.querySelectorAll('input[type=checkbox]');

    let stop = false;

    for(let i=0; i<checkbox.length; i++){
      if(checkbox[i].checked){
        stop = true;

        break;
      }
    }

    if(!stop){
      // console.log('stop');
      document.getElementById("chk_option_error").style.visibility = "visible";
      return false;
    } else {
      // console.log('continua');
      document.getElementById("chk_option_error").style.visibility = "hidden";
      return true;
    }

  }
</script>

<div class="container mt-3">

    <div class="name">
      <h3>{{$developer->user?->name}} {{$developer->last_name}}</h3>
    </div>

    <div class="img my-3">
      <img id="profile-pic" src="{{asset('storage/' . $developer->picture)}}" alt="profile-picture">
    </div>

    <form action="{{route('admin.profile.update', $developer)}}" method="POST" enctype="multipart/form-data" onsubmit="return !! (handleData())">

        @csrf
        
        @method('PUT')

        {{-- <div class="mb-3">
            <label class="fw-bold" for="last_name">Cognome</label>
            <input class="form-control @error('last_name') is-invalid @enderror" type="text" id="last_name" name="last_name" value="{{old('last_name') ?? $developer->last_name}}">
            
            @error('last_name')
              <div class="invalid-feedback">
                {{$message}}
              </div> 
            @enderror
    
        </div> --}}

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
            <label class="fw-bold" for="address">Indirizzo*</label>
            <input class="form-control @error('address') is-invalid @enderror" type="text" id="address" name="address" value="{{old('address') ?? $developer->address}}">
            
            @error('address')
              <div class="invalid-feedback">
                {{$message}}
              </div> 
            @enderror
    
        </div>

        <div class="mb-3">
            <label class="fw-bold" for="phone">Telefono</label>
            <input class="form-control @error('phone') is-invalid @enderror" type="tel" pattern="\+?[0-9]{10,13}" maxlength="13" title="Il numero dev'essere valido" id="phone" name="phone" value="{{old('phone') ?? $developer->phone}}" placeholder="Formato: +395555555555">
            
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

        {{-- Skills --}}
        <div class="mb-3 form-group">
          <strong>Specializzazioni*</strong>
          <div class="form-check">
            @foreach($skills as $skill)

            @if($errors->any())
            <input type="checkbox" id="skill-{{$skill->id}}" name="skills[]" value="{{$skill->id}}" @checked(in_array($skill->id, old('skills', [])))>
            @else
              <input type="checkbox" id="skill-{{$skill->id}}" name="skills[]" value="{{$skill->id}}" @checked($developer->skills->contains($skill))>
            @endif
              <label for="skill-{{$skill->id}}">{{$skill->name}}</label>
            @endforeach
          </div>

          <div style="visibility:hidden; color:red; " id="chk_option_error">
            Seleziona almeno una specializzazione.
          </div>
          
          @error('skills')
            <div class="text-danger">
              {{$message}}
            </div> 
          @enderror

        </div>

        <div class="mb-3">
          <label for="picture">Immagine del profilo</label>
          <input type="file" id="picture" name="picture" class="form-control @error('picture') is-invalid @enderror">
          
          @error('picture')
            <div class="invalid-feedback">
              {{$message}}
            </div>
          @enderror
        </div>


        <button class="btn btn-primary" type="submit">Salva</button>


    </form>
    <div class="disclaimer mt-3">
      <em>I campi indicati con * sono obbligatori in fase di registrazione.</em>
    </div>
</div>

@endsection
