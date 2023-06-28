@extends('layouts.admin')

@section('content')

<div class="container mt-3 profile-show">

    <h2 class="my-2">Recensioni</h2>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Commento</th>
                <th scope="col">Ricevuta il</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
            <tr>
                <td>{{$review->name}}</td>
                <td>{{$review->comment}}</td>
                <td>{{date("d/m/Y H:i", strtotime($review->created_at))}}</td>
                <td><a href="{{route('admin.reviews.show', $review)}}">Dettagli</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection