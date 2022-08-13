<?php

namespace App\Http\Controllers;

use App\Models\Drivers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Driver;

class DriverController extends Controller{


    public function useDriverdata(){
        $driver = Drivers::get()->toJson(JSON_PRETTY_PRINT);
        return response($driver, 200);
    }
    

    public function addDriverData (Request $request){
        

        $validator = Validator::make($request->all(),[
            'name' =>'required|min:6|max:255',
            'carro' =>'required|min:6|max:255',

        ]);

        if($validator->fails()) {
            $error = $validator->errors();
            return response()->json($error, 400);

        } else {
            $name = $request->input('name');
            $carro = $request->input('carro');
            $driver = Drivers::add($name,$carro);
            return response()->json($driver, 200);

        }

    }


    public function deleteDriverData(Request $request){
        $id = $request->input("id");
        $validator = Validator::make($request->all(),[
            "id"=>"required"
        ]);
        
        if($validator->fails()) {
            $error = $validator->errors();
            return response()->json($error, 400);

        } else {
            $deleted = Drivers::del($id);
            return response()->json($deleted);

        }
            
    }

}
