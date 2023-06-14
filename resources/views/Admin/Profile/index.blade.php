@extends('layouts.admin')

@section('content')


<div class="container mt-3">
<ul>
    @foreach ($developers as $developer)
    {{-- {{dd($developer)}} --}}
    <li>{{$developer->last_name}} <a href="{{route('admin.profile.show', $developer)}}">Vai</a></li>
    @endforeach
</ul>

</div>

@endsection
