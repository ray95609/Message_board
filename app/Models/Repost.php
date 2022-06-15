<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repost extends Model
{
    //設定回覆文章table
    protected $table = 'repost';
    //設定PK
    protected $primaryKey = 'id';

    //設定可異動欄位
    protected $fillable=[
        'post_id',
        'repost_name',
        'repost_content',
        'repost_user_id',
        'status',
        'created_at',
        'updated_at',
    ];


}
