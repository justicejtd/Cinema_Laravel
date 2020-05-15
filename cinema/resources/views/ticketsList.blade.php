@extends('layouts.app')
@extends('layouts.card')


<head>

</head>
<body>

@section('content')
<!-- ---- -->
@if(session()->has('message'))
    <div class="alert alert-danger">
        {{ session()->get('message') }}
    </div>

    <script>
         setTimeout(function(){
            window.location.href = "{!! url('/'); !!}";
         }, 2500);
      </script>
@endif
<!-- --- -->
@if (session()->has('success'))
<div class="alert alert-success">
Ticket has been updated!
    </div>

    <script>
         setTimeout(function(){
            window.location.href = "{!! url('/'); !!}";
         }, 2500);
      </script>
@endif
<!-- ----- -->
@if($tickets->count() == 0)
    <h3>No tickets has been purchased</h3>
    @else
    <a href="{{ URL::to('/tickets/pdf') }}">Export PDF</a>
@endif

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tickets</div>

                    <div class="card-body">


                            @foreach($tickets as $ticket)
                            @cannot('update', $ticket)
                                <div class="alert alert-success">
                                    The current user can't update the ticket
                                </div>
                            @endcannot
                            @cannot('delete', $ticket)
                                <div class="alert alert-success">
                                    The current user can't delete ticket
                                </div>
                            @endcannot
                                <form method="POST" action="{{ route('ticketUpdate', ['id'=> Auth::user()->id, 'ticketId' => $ticket->id]) }}">
                                    @csrf
                                    <div class="col-md-12">
                                    <div class="card ">
                                        <div class="card-body">

                                            <div class="form-group row">
                                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                                <div class="col-md-6">
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$ticket->email_customer}}"  disabled required autocomplete="email">

                                                </div>
                                            </div>

                                                <div class="form-group row">
                                                    <label  class="col-md-4 col-form-label text-md-right">{{ __('Movie') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="{{$ticket->id}}" type="text" class="form-control @error('movie') is-invalid @enderror" name="movie" value="{{$ticket->name_movie}}" required autocomplete="movie">

                                                        @error('movie')
                                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label  class="col-md-4 col-form-label text-md-right">{{ __('ReferenceName') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="{{$ticket->id}}" type="text" class="form-control @error('referenceName') is-invalid @enderror" name="referenceName" value="{{$ticket->owner}}" required autocomplete="referenceName">

                                                        @error('referenceName')
                                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            <div class="form-group row mb-0">
                                                <label  class="col-md-4 col-form-label text-md-right">{{ __('Qr code') }}</label>
                                            <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{@$ticket->id}}&choe=UTF-8" alt="{{$ticket->id}}">
                                            </div>
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-6 offset-md-4">
                                                        <a href="{{ route('ticketDelete', ['id'=> Auth::user()->id, 'ticketId' => $ticket->id]) }}" class="btn btn-primary">Delete</a>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                        </div>

                                    </div>
                                </div>
                                </form>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>
