<?php

namespace Tests\Feature;

use App\Models\Drivers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MotoristasTest extends TestCase
{
    use RefreshDatabase;
    public function testGetMotoristas()
    {
        $response = $this->getJson('/api/Corridas/Motoristas');

        $response->assertStatus(200);

    }

    public function testAddMotoristas(){
        $response = $this->postJson('/api/Corridas/Motoristas', [
            "name"=> "Testing with PHPUnit",
            "carro"=> "Fiat Toro"
        ]);

        $response->assertStatus(200);
             
    }

    public function testDeleteMotoristas(){

        $getLastId = Drivers::select('id')
            ->orderBy('id','DESC')
            ->first();

        $response = $this->deleteJson('/api/Corridas/Motoristas', [
            "id"=>$getLastId
        ]);

        $response->assertStatus(200);

    }
}
