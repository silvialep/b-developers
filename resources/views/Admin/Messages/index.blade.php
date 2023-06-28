@extends('layouts.admin')

@section('content')

<div class="container mt-3 profile-show">

    <h2 class="my-2">Messaggi</h2>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col" class="delete-column">Oggetto</th>
                <th scope="col" class="delete-column">Messaggio</th>
                <th scope="col" class="delete-column">Appuntamento</th>
                <th scope="col">Ricevuto il</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
            <tr>
                <td>{{$message->name}}</td>
                <td>{{$message->email}}</td>
                <td class="delete-column">{{$message->subject}}</td>
                <td class="delete-column">{{substr($message->content, 0, 50) . '...'}}</td>
                <td class="delete-column">
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