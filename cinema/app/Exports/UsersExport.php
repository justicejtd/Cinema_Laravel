<?php

namespace App\Exports;

use App\User;
use DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize; //adjust the column sizes
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;


// use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromQuery,WithHeadings,WithEvents,ShouldAutoSize,WithMultipleSheets,WithTitle
{
    use Exportable;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function query()
    {
         return User::query()->select('users.id','users.name', 'email', 'users.created_at',DB::raw('count(tickets.email_customer)'))
         ->join('tickets', 'users.email', '=', 'tickets.email_customer')
         ->where('type', $this->type)
         ->groupBy('users.id','users.name');   
        // ('SELECT users.id,users.name,users.created_at,email,count(email_customer)
        //                   From users Join tickets
        //                   On(users.email=tickets.email_customer)
        //                   Group by users.id,users.name');
            
    }

    public function headings() : array
    {
        return [
            '#ID',
            'Name',
            'Email',
            'Created At',
            'Tickets',
            'Total tickets bought on the website'
        ];
    }
    public function registerEvents(): array
    {  
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:F1'; // All headers
                $event->sheet->getStyle($cellRange)->getFont($cellRange)->setSize(14);//first get the styling and then font
                $event->sheet->setCellValue('F2','=SUM(E2:E100)');
                //WHEN YOU CLICK ENABLE EDDITING - IT ACTUALLY SHOWS THE RESULT!
            },
        ];
    }
    public function sheets(): array
    {
        $sheets = [];

        for ($i = 1; $i < 3; $i++) 
        {
            if($i==1)
            {
                $sheets[] = new AllUsersExport($this->type);
            }
            else
            {
                
                $sheets[] = new UsersExport($this->type);

            }
        }
        return $sheets;
    }
    public function title(): string
    {
        return 'Users with tickets';
    }
}
