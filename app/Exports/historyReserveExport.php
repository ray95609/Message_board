<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class historyReserveExport implements FromCollection
{
    private $userReserve;

    public function userReserve($user_id){

        $this->userReserve=Reserve::join('users', 'reserve.user_id', '=', 'users.id')
            ->select('reserve.*', 'users.*')
            ->where('reserve.user_id', '=', $user_id)->get()->all();

    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->userReserve;
    }

}
