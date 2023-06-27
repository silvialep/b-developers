@extends('layouts.admin')

@section('content')

<div class="container mt-4">
    <h1>Dettaglio della recensione</h1>
    <hr>
    <div class="mb-3 mittente">
        <h3>Mittente</h3>
        <span>{{$review->name}}</span>
    </div>
    <div class="mb-3 ricevuto">
        <h3>Data invio recensione</h3>
        <span>Ricevuto il: {{date("d/m/Y H:i", strtotime($review?->created_at))}}</span>
    </div>
    <div class="mb-3 contenuto">
        <h3>Contenuto del messaggio</h3>
        <p>
            {{$review->comment}}
        </p>
    </div>
</div>
@endsection