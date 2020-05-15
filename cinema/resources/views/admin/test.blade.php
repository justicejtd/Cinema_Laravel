@extends('layouts.app')
@extends('layouts.card')

@section('content')
<form action="/editMovies/{{\App\Movie::findOrFail(1)}}" method="GET">
{{--    @method('PUT')--}}
    <button type="submit">test</button>
</form>
    @endsection
