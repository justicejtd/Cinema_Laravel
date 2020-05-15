<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Actor;
use App\Ticket;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerMovie extends Controller
{
    //
    public function show(){
        return view('overview', ['movies' => Movie::all()]);
    }

    public function showCurrentMovie($id){
        return view('showSelectedMovie', array('currentMovie' => Movie::findOrFail($id),'actors'=>Actor::all()));
    }
    public function registerForMovie($id){
        $user = Auth::user();
        return view('purchaseTicket',array('currentMovie' => Movie::findOrFail($id),'movies'=>Movie::all(),'currentUser'=>$user));
}

    public function buyTicket(Request $request)
    {
        $this->validate($request, [
            'movie' => 'required',
//            'email' => 'required',
            'selectBox' =>['required','max:3'],
        ]);
       // $i;
        for($i=0;$i<$request->input('selectBox');$i++)
        {
        $c = "Name".($i+1);
        $this->validate($request, [
            $c => 'required'
        ]);
        $t = new Ticket();
        //On left field name in DB and on right field name in Form/view
        // $t->email_customer = $request->input('email');
        //$t->email_customer = "denitsa123@gmail.com";
        $t->email_customer = Auth::user()->email;
        $t->owner = $request->input($c);
        $t->name_movie = $request->input('movie');
        $t->userId = Auth::user()->id;
        $t->save();
        }
        $user = Auth::user();
        return view('ticketsList', ['currentUser' => $user, 'tickets' => Ticket::all()->where('userId', $user->id)]);

    }
}
