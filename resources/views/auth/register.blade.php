@extends('layouts.app')

@section('content')

<script>
    // checkbox validation
    function handleData()
    {
        const form_data = new FormData(document.querySelector("form"));
        if(!form_data.has("skills[]"))
        {
            document.getElementById("chk_option_error").style.visibility = "visible";
            return false;      
        }
        else
        {
            document.getElementById("chk_option_error").style.visibility = "hidden";
            return true;
        }
    }
    function checkPsw(){
        const password = document.getElementById('password');
        const passwordConfirm = document.getElementById('password-confirm');


        if(password.value === passwordConfirm.value){
            document.getElementById("chk_psw_error").style.visibility = "hidden";
            return true;
        } else {
            document.getElementById("chk_psw_error").style.visibility = "visible";
            return false;
        }
        
    }
</script>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrati') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" onsubmit="return !! (handleData() & checkPsw())">    
                        @csrf

                        <div class="mb-4 row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome*') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Cognome*') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">

                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo*') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">

                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="skills" class="col-md-4 col-form-label text-md-right">{{ __('Specializzazioni*') }}</label>

                            <div class="form-check">
                                @foreach($skills as $skill)
                                @if($skill->name != 'Tutte le specializzazioni')
                                    <input type="checkbox" id="skill-{{$skill->id}}" name="skills[]" value="{{$skill->id}}" @checked(in_array($skill->id, old('skills', [])))>
                                    <label for="skill-{{$skill->id}}">{{$skill->name}}</label>
                                @endif
                                @endforeach
                            </div>

                            <div style="visibility:hidden; color:red; " id="chk_option_error">
                                Seleziona almeno una specializzazione.
                            </div>

                            @error('skills')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="mb-4 row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail*') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password*') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" minlength="8" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password*') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" minlength="8" required autocomplete="new-password">
                            </div>
                        </div>

                        <div style="visibility:hidden; color:red; " id="chk_psw_error">
                            Le password devono coincidere.
                        </div>

                        <div class="mb-4 row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrati') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="disclaimer">
                        <em>I campi indicati con * sono obbligatori in fase di registrazione.</em>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
