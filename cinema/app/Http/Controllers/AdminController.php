<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Policies\TicketPolicy;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    //
    public function show(){
        $this->authorize('viewAddMovies', Auth::user());
        return view('admin.addMovies');
    }
    public function showExportUsers()
    {
        $this->authorize('viewUsers', Auth::user());
        $users = User::paginate(8); //to display 5 records per page - getting all the records from the database
        return view('admin.exportUsersToExcel',['users'=>$users]);
    }
   
    public function Export($type)
    {
        return Excel::download(new UsersExport('User'), 'usersExcelSheet.' . $type);
    }

    public function deleteMovie($movieId)
    {
        $currentMovie = Movie::findOrFail($movieId);
        Movie::destroy($movieId);
        return redirect('/');
    }

    public function movieUploadPost(Request $request)

    {
//        $validation = $request->validate([
//            'name' => ['required', 'string', 'max:255'],
////            'email' => ['required', 'string', 'email', 'max:255'],
//            'password' => ['required', 'string', 'min:4', 'confirmed'],
//        ]);

        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'date' => ['required', 'string', 'max:10', 'min:10'],
        ]);
//        $imageName = time().'.'.request()->image->getClientOriginalExtension();
//       // request()->image->move(public_path('movies'), $imageName);
//
////        $image = $request->file('image');
//        $image = request()->image;
//        $destinationPath = public_path('movies');
//       // $img = Image::make($image->path());
//        $image->resize(100, 100, function ($constraint) {
//            $constraint->aspectRatio();
//        })->save($destinationPath.'/'.$imageName);
//
//        //$destinationPath = public_path('/images');
//        $image->move($destinationPath, $imageName);


        $image = $request->file('image');
        $input['imagename'] = time().'.'.$image->extension();

        $destinationPath = public_path('/movies');
        $img = Image::make($image->path());

        $waterMarkImage = Image::make(public_path('uploads/waterMark.png'))->resize(215,25);
        $img->resize(250, 400)->insert($waterMarkImage,'bottom-right')->save($destinationPath.'/'.$input['imagename']);


        $newMovie = new Movie();
        $newMovie->name = $request->input('name');
        $newMovie->description = $request->input('description');
        $newMovie->date = $request->input('date');
        $newMovie->imgRef = $input['imagename'];
        $newMovie->save();
       $destinationPath = public_path('/movies');


        // apply pixelation effect
        $img->pixelate(12);
        $destinationPath = public_path('/pixelate');
        $img->save($destinationPath.'/'.$input['imagename']);
       //$image->move($destinationPath, $input['imagename']);

        return redirect()->back()
            ->with('success','You have successfully upload image.')
            ->with('movieImg',$input['imagename']);
    }
}
