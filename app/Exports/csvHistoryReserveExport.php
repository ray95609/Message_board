<?php

namespace App\Exports;


use App\Models\Reserve;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class csvHistoryReserveExport implements FromQuery,WithHeadings,ShouldAutoSize
{

    use Exportable;

    public $user_id;

    public function __construct($user_id){

        $this->user_id=$user_id;

    }

    public function query()
    {
        $queryData=Reserve::join('users','reserve.user_id','=','users.id')
            ->select('reserve.id as id','date','time','designer','users.name as name')
            ->where('user_id','=',$this->user_id);
        return $queryData;
    }

    public function headings(): array
    {   return [
        '預約編號',
        '預約日期',
        '預約時間',
        '預約設計師',
        '預約者'
    ];
    }
}
