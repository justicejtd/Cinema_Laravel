@extends('layouts.app')
@extends('layouts.card')

<title>Cinema</title>

<head>
<link href="{{ asset('css/overview.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{asset('js/overview.js')}}" rel="script"></script>
</head>
@section('content')
<body>
<div class="row main">
@foreach($movies as $movie)
<div class="col-sm-3">
<div class="card">
    <img src='{{ asset('movies/'.$movie->imgRef.'') }}'
         onmouseout="src='{{ asset('movies/'.$movie->imgRef.'') }}'"
         onmouseover="this.src='{{ asset('pixelate/'.$movie->imgRef.'') }}'" class="card-img" alt="{{$movie->name}}">
  <div class="card-body">
      @if(strlen($movie->name) >= 20)
          <h4 class="card-title">{{substr($movie->name, 0 , 15)}}...</h4>
      @else
          <h4 class="card-title">{{$movie->name}}</h4>
      @endif
    <h5 class="card-text">{{$movie->date}}</h5>
    <p class="card-text">{{substr($movie->description, 0 , 20)}}...</p>
    <a href="/showMovie/{{$movie->id}}}" id="{{$movie->id}}" class="btn btn-primary" >See the movie!</a>
    <!-- href is needed so that letters are white - acts as a link -->
  </div>

</div>
</div>
@endforeach
</div>
</body>
@endsection
