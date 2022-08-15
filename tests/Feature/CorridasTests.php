<?php

namespace Tests\Feature;

use App\Models\Users;
use App\Models\Drivers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    public function testToMakeCorrida()
    {
        $makeUser = $this->postJson('/api/Corridas/Usuarios', [
            "name"=>"Testing with PHPUnit",
            "email"=>"phpunittest@gmail.com"
        ]);

        $makeUser->assertStatus(200);

        $getLastId = Users::select('id')
        ->orderBy('id','DESC')
        ->first();


        $makeDriver =  $this->postJson('/api/Corridas/Motoristas', [
            "name"=> "Testing with PHPUnit",
            "carro"=> "Fiat Toro"
        ]);

        $makeDriver->assertStatus(200);

        $getLastDriverId = Drivers::select('id')
            ->orderBy('id','DESC')
            ->first();

        $response = $this->postJson('api/Corridas/Corridas', [

            
            "idUser"=> $getLastId,
            "idDriver"=> $getLastDriverId,
            "valor"=> 10.95,
            "pagamento"=> "pix"

        ]);

        $response->assertStatus(200);

    }

    
}
