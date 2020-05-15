@extends('layouts.app')
@extends('layouts.card')


<body>
@section('content')
<div style="margin-left:15pt;margin-right:15pt">
<h4>All users present in cinema database</h4>
<div class="form-group">
                 <a href="/export/xlsx" class="btn btn-success">Export to .xlsx</a>
             </div>
<table class="table table-striped table-bordered ">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($users as $u)
                    @if($u->type==='User')
                    <tr>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->created_at }}</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }} 
            <!-- displaying only 8 records - can view the pages for more records  -->
<div>
@endsection
</body>
