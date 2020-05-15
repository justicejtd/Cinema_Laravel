@extends('layouts.app')
@extends('layouts.card')

<title>{{$currentMovie->name}}</title>

<head>
<link href="{{ asset('css/overview.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{asset('js/showSelectedMovie.js')}}" rel="script"></script>
</head>

@section('content')
<body>
<div class="row secondary">
<div class="col-sm-3">
    <div class="card2">
        <img class="pic" src="{{ asset('movies/'.$currentMovie->imgRef.'') }}" id="{{$currentMovie->id}}" alt="{{$currentMovie->name}}"><br>
    </div>
</div>
<div class="col-sm-6">
    <h1>{{$currentMovie->name}}</h1><br>
    <p>Date: {{$currentMovie->date}}<br>
        Description: {{$currentMovie->description}}<br></p>
    Actors:
    <p>
    @foreach($actors as $actor)
    @if(strpos($actor->movies,$currentMovie->name) !== false)
    Name: {{$actor->name}}<br>
    @endif
    @endforeach
    </p>
  @guest
  <a href="{{ url('login') }}"  onclick="message('You need to be logged in to purchase a ticket!')" class="btn btn-primary" >Purchase ticket now!</a>
  @endguest

  @can('viewTickets', Auth::user())
  <a href="/registerMovie/{{$currentMovie->id}}"   class="btn btn-primary" >Purchase ticket now!</a>
  @endcan
  <!-- @can('viewAddMovies', Auth::user())
  <a href="/registerMovie/{{$currentMovie->id}}"   class="btn btn-primary" >Change details of the movie!</a>
  @endcan -->
  
</div>
</div>


</body>
@endsection
