<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\types;
use App\Model\type_user_data;
use App\Model\users;

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

    public function add_provider_data(Request $request){
        $data_provider = new users;
        $data_provider->company_name = $request->company_data;
        $data_provider->address = $request->address_data;
        $data_provider->nit = $request->nit_data;
        $data_provider->credit_days = $request->credit_days_data;
        $data_provider->type_user = 1;
        if($data_provider->save()){
            return response()->json($data_provider, 200);
        }
    }

}
