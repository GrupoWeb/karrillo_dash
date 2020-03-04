<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class type_user_data extends Model
{
    protected $table = 'type_user_data';
    public $timestamps = false;
    protected $fillable = [
        'type_user_data_id','description'
    ];
}
