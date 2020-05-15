<?php

use Illuminate\Database\Seeder;
use App\Ticket;


class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /* $arrEmails = array("denitsa123@gmail.com","justice123@gmail.com");
        $name ="Denitsa";
        $nameb ="Justice";
        DB::table('tickets')->Delete();

        for($i=0;$i<count($arrEmails);$i++)
        {
//            DB::table('tickets')->Insert([
//                'email_customer' => $arrEmails[$i],
//                'owner' =>$name,
//                'name_movie'=>"Toy Story 4",
//                'userId' => $i
//            ]);

            $t = new Ticket;
            $t->email_customer = $arrEmails[$i];
            $t->name_movie = "Toy Story 4";
            $t->owner = $name;
            $t->userId = $i++;
            $t->save();
        }
        for($i=0;$i<count($arrEmails);$i++)
        {
            DB::table('tickets')->updateOrInsert([
                'email_customer' => $arrEmails[$i],
                'owner' =>$nameb,
                'name_movie'=>"Alita: Battle Angel",
                'userId' => $i
            ]);
        }*/
    }
    }
