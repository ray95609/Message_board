<?php

namespace App\Exports;

use App\Models\Reserve;
use Maatwebsite\Excel\Concerns\FromCollection;


class ReserveExport implements FromCollection
{


    public function collection()
    {
        return Reserve::all();
    }

    public function headings(): array
    {
        return ['id','date','time','designer','name'];
    }


}
