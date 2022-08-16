<?php

namespace Tests\Feature;

use App\Models\Corridas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CorridaTest extends TestCase{


    public function testMakeCorrida()
    {

        $response = $this->postJson('api/Corridas/Corridas', [
            "idUser"=> 1,
            "idDriver"=> 1,
            "valor"=> 10.95,
            "pagamento"=> "pix"

        ]);

        $response->assertStatus(200);
      
    }

    public function testEndCorrida(){

        $response = $this->postJson('api/Corridas/EncerrarCorridas', [
            "id"=> 1
        ]);

        $response->assertStatus(200);
    }

    public function testPayCorrida(){
        $response = $this->postJson('api/Corridas/PagarCorridas', [
            "id"=> 1
        ]);

        $response->assertStatus(200);
    }

    public function testMakeCorrida2(){
        {

            $response = $this->postJson('api/Corridas/Corridas', [
                "idUser"=> 1,
                "idDriver"=> 1,
                "valor"=> 19.80,
                "pagamento"=> "credito"
    
            ]);
    
            $response->assertStatus(200);
          
        }
    }

    public function testCancelCorrida()
    {
        $response = $this->postJson('/api/Corridas/CancelarCorridas', [
            "id"=> 1
        ]);

        $response->assertStatus(200);
    }

}