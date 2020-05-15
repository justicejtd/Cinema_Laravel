<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrEmails = array("denitsa123@gmail.com","t-justice98@hotmail.com","random123@gmail.com", "admin@hotmail.com");
        DB::table('users')->Delete();
        //User::truncate();
        $password = Hash::make('secret');

        for($i=0;$i<count($arrEmails);$i++)
        {
            $myUser = new User;
            $myUser->name = substr($arrEmails[$i], 0, 7);
            $myUser->email = $arrEmails[$i];
            $myUser->password = $password;
            if ($i == 3){
                $myUser->type = "Admin";
            }
            $myUser->save();
        }
    }
}
