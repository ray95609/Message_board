<?php

namespace App\Imports;

use App\Models\Posts;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class postImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Posts([
            'post_name'=>$row['post_name'],
            'post_content'=>$row['post_content'],
            'post_user_id'=>$row['post_user_id'],

        ]);
    }
}
