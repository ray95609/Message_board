<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Api_Covid_19 extends Model
{
    protected $table ='api_covid_19';

    protected $primaryKey='id';

    protected $fillable=[
        'date',
        'curdate_diagnose',
        'total_diagnose',
        'local',
        'country',
        'created_at',
        'updated_at'

    ];
}
