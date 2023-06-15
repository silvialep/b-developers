@extends('layouts.admin')

@section('content')

<div class="container">
    <h1>{{$review->name}}</h1>
    <span>Ricevuto il: {{date("d/m/Y H:i", strtotime($review?->created_at))}}</span>

    <p>
        {{$review->comment}}
    </p>

</div>


@endsection