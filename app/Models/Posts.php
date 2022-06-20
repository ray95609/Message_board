<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    // 設定 table
    protected $table = 'posts';
    // 設定 table PK
    protected $primaryKey = 'id';
    // 設定 table 可異動 column
    protected $fillable = [
        //    'id',
        'post_name',
        'post_content',
        'post_user_id',
        'created_at',
        'updated_at',
    ];



}
