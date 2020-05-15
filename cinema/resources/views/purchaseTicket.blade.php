@extends('layouts.app')
@extends('layouts.card')

<script type="text/javascript" src="{{asset('js/showSelectedMovie.js')}}" rel="script"></script>

@section('content')
<div class="container">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="row justify-content-center"> <!-- right,left -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Purchase your ticket now!') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{Route('buyTicket', ['id' => Auth::user()->id])}}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" name ="email" type="email" class="form-control" name="email" value="{{ $currentUser->email }}" disabled required autocomplete="email" autofocus>
{{--                                @error('email') is-invalid @enderror"--}}
{{--                                        @error('email')--}}
{{--                                        <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                                        @enderror--}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label  class="col-md-4 col-form-label text-md-right">{{ __('Movie') }}</label>

                            <div class="col-md-6">
                            <select id="selectMovie" name="movie" class="form-control list">
                            <option>{{$currentMovie->name}}</option>
                            @foreach($movies as $movie)
                            @if($movie->id !== $currentMovie->id)
                            <option>{{$movie->name}}</option>
                            @endif
                            @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label  class="col-md-4 col-form-label text-md-right">{{ __('Number of people') }}</label>

                            <div class="col-md-6">
                            <select id="selectBox" name="selectBox" class="form-control @error('selectBox') is-invalid @enderror" name="email" class="form-control list" onchange="saveTheValue()">
                            <option hidden selected>Select number of people</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            </select>
                            </div>

                        </div>

                        <div class="form-group row" id="divAdded">
                        @error('nameOwner')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                         </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Purchase') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
