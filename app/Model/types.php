<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class types extends Model
{
    protected $table = 'types';
    public $timestamps = false;
    protected $fillable = [
        'type_id','description'
    ];

}
