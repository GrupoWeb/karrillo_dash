<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\types;

class karrillo_app extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add_provider(){

    }

    public function add_types($info_data){
        $data = new types;
        $data->description = $info_data;
        if($data->save()){
            return response()->json($data,200);
        }
    }

}
