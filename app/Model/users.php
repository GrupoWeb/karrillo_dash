<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    protected $table = 'user_data';

    protected $fillable = [
        'user_data_id','nit','first_name','last_name','address','credit_days','credit_limit','type_user','company_name','created_at','updated_at'
    ];
}
