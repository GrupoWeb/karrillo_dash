<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class phone_data extends Model
{
    protected $table = 'phone_data';
    public $timestamps = false;
    protected $fillable = [
        'phone_id','user_data_id','type_id','number'
    ];
}
