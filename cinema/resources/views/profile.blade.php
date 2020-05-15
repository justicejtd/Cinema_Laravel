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
@endif
@if (session()->has('dataChanged'))
<div class="alert alert-success">
{{ session()->get('dataChanged') }}</div>

    <script>
         setTimeout(function(){
            window.location.href = "{!! url('/'); !!}";
         }, 2500);
      </script>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- ----- -->
<div class="row main justify-content-center">
<div class="col-sm-2">
<!-- Check if the user has an image -->
@if($currentUser->image==NULL)
    <img style="width:250px;height:250px; border-radius: 50%;" src="/uploads/default.jpg" />
@else
<img style="width:250px;height:250px;" src="/uploads/{{$currentUser->image}}" />
@endif

</div>

<div class="col-sm-9">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $currentUser->name }}</div>
                    <div class="card-body">
                        <form method="post" action="{{ route('profileUpdate', ['id'=> Auth::user()->id]) }}" enctype ="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $currentUser->name }}"  autocomplete="name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $currentUser->email}}" disabled autocomplete="email">
{{--                                    @error('email') is-invalid @enderror"--}}
{{--                                    @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">

                                    </div>
                            </div>

                            <!-- <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div> -->

                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Profile Image') }}</label>

                                <div class="col-md-6">
                                    <input type="file" name ="image" >

                                    </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


</body>
