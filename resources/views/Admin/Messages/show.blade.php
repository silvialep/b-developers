@extends('layouts.admin')

@section('content')

<div class="container">
    <h1>{{$message->name}}</h1>
    <span>Ricevuto il: {{date("d/m/Y H:i", strtotime($message?->created_at))}}</span>

    <p>
        {{$message->content}}
    </p>

</div>


@endsection