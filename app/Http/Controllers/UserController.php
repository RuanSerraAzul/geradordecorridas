<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function useUserdata(){
        $users = Users::get()->toJson(JSON_PRETTY_PRINT);
        return response($users, 200);
    }

    public function addUserData(Request $request){

        $validator = Validator::make($request->all(),[
            'name' =>'required|min:6|max:255',
            'email' =>'required|email|unique:users'
        ]);

        if($validator->fails()) {
            $error = $validator->errors();

            return response()->json($error, 400);
        } else {
            $name = $request->input('name');
            $email = $request->input('email');
            $user = Users::add($name,$email);

            return response()->json($user);
        }
    }

    public function deleteUserData(Request $request){
        $id = $request->input("id");

        $validator = Validator::make($request->all(),[
            "id"=>"required"
        ]);
        
        if($validator->fails()) {
            $error = $validator->errors();

            return response()->json($error, 400);
        } else {
            $deleted = Users::del($id);

            return response()->json($deleted);
        }
    }
}
