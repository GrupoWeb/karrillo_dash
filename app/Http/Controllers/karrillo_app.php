<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\types;
use App\Model\type_user_data;

class karrillo_app extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function add_types_phone($info_data){
        $data = new types;
        $data->description = $info_data;
        if($data->save()){
            return response()->json($data,200);
        }
    }

    public function add_types_user_data($info_data){
        $data = new type_user_data;
        $data->description = $info_data;
        if($data->save()){
            return response()->json($data,200);
        }
    }

}
