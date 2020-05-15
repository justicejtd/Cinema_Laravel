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
use Maatwebsite\Excel\Concerns\WithTitle;
// use Maatwebsite\Excel\Concerns\FromCollection;

class AllUsersExport implements FromQuery,WithHeadings,WithEvents,ShouldAutoSize,WithTitle
{
    use Exportable;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function query()
    {
         return User::query()->select('id','name', 'email', 'created_at')->where('type', $this->type);
    }

    public function headings() : array
    {
        return [
            '#ID',
            'Name',
            'Email',
            'Created At'
        ];
    }
    public function registerEvents(): array
    {  
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:F1'; // All headers
                $event->sheet->getStyle($cellRange)->getFont($cellRange)->setSize(14);//first get the styling and then font
            },
        ];
    }
    public function title(): string
    {
        return 'All users';
    }
}
