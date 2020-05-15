<?php

namespace App\Http\Controllers;

use App\Movie;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //
        $users = User::all();
        //return $movies;
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // fix upload image
        $validation = $request->validate([
        'password' => ['string', 'min:4'],
        'email' => ['required', 'string', 'email', 'max:255'],
    ]);

    // if(strpos($request->email, '@') == false)
    // {
    //     return response()->json(array(
    //         'status' => "The specified email is not correct"
    //     ));
    // }
    // else if($request->name==null ||$request->email==null||$request->password==null||$request->type)
    // {
    //     return response()->json(array(
    //         'status' => "Some of the required information is missing"
    //     ));
    // }
    // else
    // {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =Hash::make($request->password);
        $user->type = $request->type;

        if($user->save()){
            return response()->json(array(
                '$users' => $user->toArray()),
                200
            );
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        //
        return response()->json(User::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id)
    {
        //
        //Return message for validation instead of returning a overview page
        $validation = request()->validate([
            'password' => ['string', 'min:4'],
            'email' => ['string', 'email', 'max:255'],
        ]);
        //put if statement for each field
        $user = User::findOrFail($id);
        $user->name = request()->name;
        $user->email = request()->email;
        $user->password =Hash::make(request()->password);
        if (request()->type != null){
            $user->type = request()->type;
        }

        if($user->save()){
            return response()->json(array(
                'users' => $user->toArray()),
                200
            );
        }
        return response()->json(array(
            'status' => "User has not been updated"
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);
        if($user->delete()){
            return response()->json(array(
                'status' => "user has been deleted",
                200
            ));
        }
        return response()->json(array(
            'status' => "user has been not deleted"
        ));
    }
}
