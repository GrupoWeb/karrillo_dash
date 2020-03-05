<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\types;
use App\Model\type_user_data;
use App\Model\users;
use App\Model\phone_data;
use Illuminate\Support\Facades\DB;

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

    public function get_provider(){
        $data_response = DB::SELECT('call get_provider_data();');
        return response()->json($data_response, 200);
    }

    public function add_provider_data(Request $request){
        $data_provider = new users;
        $data_provider->company_name = $request->company_data;
        $data_provider->address = $request->address_data;
        $data_provider->nit = $request->nit_data;
        $data_provider->credit_days = $request->credit_days_data;
        $data_provider->type_user = 1;
        $data_provider->contact_name = $request->contact_name;
        $data_provider->save();
        $id_new = $data_provider->id;

        $data_phone = new phone_data;
        $data_phone->user_data_id = $id_new;
        $data_phone->type_id = 1;
        $data_phone->number = $request->phone_p_data;
        $data_phone->save();

        $data_phone = new phone_data;
        $data_phone->user_data_id = $id_new;
        $data_phone->type_id = 2;
        $data_phone->number = $request->phone_s_data;
        $data_phone->save();

        $data_phone = new phone_data;
        $data_phone->user_data_id = $id_new;
        $data_phone->type_id = 3;
        $data_phone->number = $request->phone_c_data;
        $data_phone->save();

        return response()->json($data_provider, 200);
    }

}
