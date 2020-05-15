@extends('layouts.card')

<h1>Tickets List</h1>
<table>
    <thead>
    <tr>
        <th>Ticket Id</th>
        <th>Movie</th>
        <th>Email</th>
        <th>User Reference</th>
        <th>Qr code</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tickets as $ticket)
        <tr>
            <td>{{ $ticket->id }}</td>
            <td>{{ $ticket->name_movie }}</td>
            <td>{{ $ticket->email_customer}}</td>
            <td>{{ $ticket->owner }}</td>
            <td><img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={{$ticket->id}}&choe=UTF-8" alt="{{$ticket->id}}"></td>
        </tr>
    @endforeach
    </tbody>
</table>
