@extends('layouts.admin')

@section('content')

<div class="container mt-3">

    <h2 class="my-2">Messaggi</h2>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Oggetto</th>
                <th scope="col">Messaggio</th>
                <th scope="col">Appuntamento</th>
                <th scope="col">Ricevuto il</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
            <tr>
                <td>{{$message->name}}</td>
                <td>{{$message->email}}</td>
                <td>{{$message->subject}}</td>
                <td>{{substr($message->content, 0, 50) . '...'}}</td>
                <td>
                    @if(isset($message->meeting_date))
                        {{date("d/m/Y H:i", strtotime($message->meeting_date))}}
                    @else 
                        -
                    @endif
                </td>
                <td>{{date("d/m/Y H:i", strtotime($message->created_at))}}</td>
                <td><a href="{{route('admin.messages.show', $message)}}">Dettagli</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection