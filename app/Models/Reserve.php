<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
   protected $table='reserve';

   protected $primaryKey='id';

   protected $fillable=[
       'date',
       'time',
       'status',
       'designer',
       'user_id',
       'update_id',
       'created_at',
       'updated_at'

   ];



}
