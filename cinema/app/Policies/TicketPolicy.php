<?php

namespace App\Policies;

use App\Movie;
use App\Ticket;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class TicketPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any tickets.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
        //return true;
    }

    public function viewAddMovies(User $user){
        if ($user->type == 'Admin'){
            return true;
        }
        return false;
    }
    public function viewTickets(User $user){
        if ($user->type == 'Admin'){
            return false;
        }
        return true;
    }
    public function viewUsers(User $user)
    {
        if($user->type =='Admin')
        {
            return true;
        }
        return false;
    }

    public function viewDeleteMovie(User $user)
    {
        if ($user->type == 'Admin'){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the ticket.
     *
     * @param  \App\User  $user
     * @param  \App\Ticket  $ticket
     * @return mixed
     */
//    public function view(User $user, Ticket $ticket)
//    {
//        //
//        return $user->id == $ticket->userId;
//    }

    public function view(User $user){
        //return true;
    }

    /**
     * Determine whether the user can create tickets.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the ticket.
     *
     * @param  \App\User  $user
     * @param  \App\Ticket  $ticket
     * @return mixed
     */
    public function update(User $user, Ticket $ticket)
    {
        //
       return $user->id == $ticket->userId;
    }

    /**
     * Determine whether the user can delete the ticket.
     *
     * @param  \App\User  $user
     * @param  \App\Ticket  $ticket
     * @return mixed
     */
    public function delete(User $user, Ticket $ticket)
    {
        //
        return $user->id == $ticket->userId;
    }

    /**
     * Determine whether the user can restore the ticket.
     *
     * @param  \App\User  $user
     * @param  \App\Ticket  $ticket
     * @return mixed
     */
    public function restore(User $user, Ticket $ticket)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the ticket.
     *
     * @param  \App\User  $user
     * @param  \App\Ticket  $ticket
     * @return mixed
     */
    public function forceDelete(User $user, Ticket $ticket)
    {
        //
    }
}
