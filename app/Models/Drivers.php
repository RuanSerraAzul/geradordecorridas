<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Drivers extends Model
{

        public $timestamps = false;
    
        protected $table = 'drivers';

        protected $fillable = [
            "name","carro","saldo","corridas_feitas"
        ];
        
        public static function add($name, $carro){
            DB::table('drivers')->insert([
                'name' => $name,
                'carro' => $carro
            ]);
        }
    
        public static function del($id){
            DB::table('drivers')->where('id', $id)->delete();
    
        }
    
    
    
}
