@extends('layouts.admin')

@section('content')

<div class="container mt-4">
    <h1>Dettagli del messaggio</h1>
    <hr>
    <div class="mb-3 mittente">
        <h3>Mittente</h3>
        <span>{{$message->name}}</span>
    </div>
    <div class="mb-3 ricevuto">
        <h3>Data invio messaggio</h3>
        <span>Ricevuto il: {{date("d/m/Y H:i", strtotime($message?->created_at))}}</span>
    </div>
    <div class="mb-3 contenuto">
        <h3>Contenuto del messaggio</h3>
        <p>
            {{$message->content}}
        </p>
    </div>
    @if(isset($message->meeting_date))
        <div class="mb-3 appuntamento">
            <h4>Data di appuntamento</h4>
            <span>{{date("d/m/Y H:i", strtotime($message?->meeting_date))}}</span>
        </div>
    @endif

</div>


@endsection