<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    public $timestamps = false;

    protected $table = 'users';

    protected $fillable = [
        "name","email","corridas_feitas"
    ];
    
    public static function add($name, $email){
        DB::table('users')->insert([
            'name' => $name,
            'email' => $email
        ]);
    }

    public static function del($id){
        DB::table('users')->where('id', '=', $id)->delete();

    }


}
