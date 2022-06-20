<?php

namespace App\Models;

class Barber extends \Illuminate\Database\Eloquent\Model
{
    protected $table='barber';

    protected $primaryKey=['date','time'];

    protected $fillable=[
        'status',
        'teacher',
        'user_id',
        'update_id',
        'created_at',
        'updated_at'

    ];
}
