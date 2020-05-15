<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\User;
use PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class TicketsListController extends Controller
{
    public function showTickets($id){
        $currentUser = User::findOrFail($id);
        //$tickets = Ticket::all()->where('userId', $currentUser->id);
        if ($currentUser == Auth::user()){
            return view('ticketsList', ['currentUser' => $currentUser, 'tickets' => Ticket::all()->where('userId', $currentUser->id)]);
        }
        else{
            return back()->with('message', 'Specified user was not found in the database!');
        }
    }
       public function updateTicket( Request $request,$id,$ticketId){

        $validation = $request->validate([
            'movie' => 'required',
            'referenceName'=> 'required',
        ]);
        $currentTicket = Ticket::findOrFail($ticketId);
        $this->authorize('update', $currentTicket);
        $currentTicket->name_movie = $request->input('movie');
        $currentTicket->owner = $request->input('referenceName');
        @$currentTicket->save();

        return redirect('/user/'.$id.'/tickets')->with('success', true);
    }

    public function deleteTicket($id, $ticketId){
        $currentTicket = Ticket::findOrFail($ticketId);
        $this->authorize('delete', $currentTicket);
        Ticket::destroy($ticketId);
        return redirect('/user/'.$id.'/tickets')->with('message', 'Ticket has been deleted!');
    }

    public function exportTickets(){

        // Fetch all customers from database
        $tickets = Ticket::all()->where('userId', Auth::user()->id);
        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('exportTickets', ['tickets' => $tickets]);
        // If you want to store the generated pdf to the server then you can use the store function
        $pdf->save(storage_path().'_filename.pdf');
        // Finally, you can download the file using download function
        return $pdf->download('tickets.pdf');

    }
}
