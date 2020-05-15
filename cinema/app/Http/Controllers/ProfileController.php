<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use File;



class ProfileController extends Controller
{
    //
    public function showProfile($id){
        $currentUser = User::findOrFail($id);
        if ($currentUser == Auth::user()){
            return view('profile', ['currentUser' => $currentUser]);
        }
        else{
            return back()->with('message', 'Specified user was not found in the database!');
        }
    }

    public function updateProfile(Request $request, $id){

        $message="No information changed!";
        $currentUser = User::findOrFail($id);
        if ($currentUser == Auth::user())
        {
            $pass=$request->input('password');
            $namep=$request->input('name');
            $imgp=$request->File('image');
            if($pass!=null)
            {
            $validation = $request->validate([
            'password' => ['string', 'min:4'],
//            'email' => ['required', 'string', 'email', 'max:255'],
             ]);
             $currentUser->password = Hash::make($request->input('password'));
             $message="Information changed!";
             }

            if($namep!=($currentUser->name))
            {
            $validation = $request->validate([
                'name' => ['string', 'max:255'] ]);
                $currentUser->name = $request->input('name');
                $message="Information changed!";
            }
            if($imgp!=null)
            {
                $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3000',
                ]);
                $newImage = self::resize_image($request,$currentUser);
                //  Image::make($request->file('image'))->resize(280, 280)->mask(Image::make(public_path('uploads/mask.png')))->response('png');
                

               
                // return Image::make($request->file('image'))->resize(280, 280)->mask(Image::make(public_path('uploads/mask.png')))->response('png');
                 $currentUser->image = $newImage;
                $changed = true;
                $message="Information changed!";
            }
            $currentUser->save();
            return redirect()->back()->with('dataChanged', $message );
        }
        else{
            return back()->with('message', 'Specified user was not found in the database!');
        }
    }


    function resize_image(Request $request,User $user)
    {
        $default = 'avatar';

        // $image_name = time() . '(' . $email . ')' . '.' . $image->getClientOriginalExtension();

        $email = $user ->email;
        $image_name = $email . '.' . 'png';

        $file  = public_path('\uploads' . '/' . $image_name);

        if(File::exists($file))
        {
            File::delete($file);  // or unlink($filename);
        }



        $waterMarkImage = Image::make(public_path('uploads/waterMark.png'))->resize(215,25);
        Image::make($request->file('image'))->resize(280, 280)->insert($waterMarkImage,'center')->mask(Image::make(public_path('uploads/mask.png')))->save($file);
        return $image_name;
    }
}

