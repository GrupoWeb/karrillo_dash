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

    public function get_provider_filter(Request $request){
        $data_response = DB::SELECT("SELECT provider.user_data_id, provider.nit, provider.address, provider.credit_days, provider.credit_limit, UPPER(provider.company_name) AS company_name, UPPER(provider.contact_name) AS contact_name,
            max(case when phones.type_id = '1' then number end) as principal, max(case when phones.type_id = '2' then number end) as secundario, max(case when phones.type_id = '3' then number end) as contacto
                FROM user_data provider
                        LEFT JOIN phone_data phones ON phones.user_data_id = provider.user_data_id
                WHERE provider.status = 1 and provider.company_name LIKE '%".$request->dato."%' or provider.nit LIKE '%".$request->dato."%'
                group by provider.company_name,1,2,3
                order by provider.company_name ;");
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

    public function update_provider_data(Request $request){
        $count_phone = phone_data::select('phone_id')->where('user_data_id' ,'=', $request->id)->count();
        
        if($count_phone > 0){
            $update = users::where('user_data_id', $request->id)->update([
                'nit' => $request->nit_data,
                'address' => $request->address_data,
                'credit_days' => $request->credit_days_data,
                'company_name' => $request->company_data,
                'contact_name' => $request->contact_name
            ]);

            $data_phone = phone_data::select('phone_id')->where('user_data_id' ,'=', $request->id)->get();
            $update_phone_1 = phone_data::where('phone_id','=', $data_phone[0]->phone_id)->update(['number' => $request->phone_p_data]);
            $update_phone_2 = phone_data::where('phone_id','=', $data_phone[1]->phone_id)->update(['number' => $request->phone_s_data]);
            $update_phone_3 = phone_data::where('phone_id','=', $data_phone[2]->phone_id)->update(['number' => $request->phone_c_data]);
        }else{
            $update = users::where('user_data_id', $request->id)->update([
                'nit' => $request->nit_data,
                'address' => $request->address_data,
                'credit_days' => $request->credit_days_data,
                'company_name' => $request->company_data,
                'contact_name' => $request->contact_name
            ]);

            $data_phone = new phone_data;
            $data_phone->user_data_id = $request->id;
            $data_phone->type_id = 1;
            $data_phone->number = $request->phone_p_data;
            $data_phone->save();

            $data_phone = new phone_data;
            $data_phone->user_data_id = $request->id;
            $data_phone->type_id = 2;
            $data_phone->number = $request->phone_s_data;
            $data_phone->save();

            $data_phone = new phone_data;
            $data_phone->user_data_id = $request->id;
            $data_phone->type_id = 3;
            $data_phone->number = $request->phone_c_data;
            $data_phone->save();

        }
        return response()->json(true, 200);
    }

    public function delete_provider_data(Request $request){
        $delete = users::where('user_data_id',$request->id)->update(['status' => 0]);
        return response()->json($delete, 200);
    }

}
