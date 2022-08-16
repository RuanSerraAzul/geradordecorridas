<?php

namespace Tests\Feature;

use App\Models\Corridas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CancelarTests extends TestCase{ 

    public function testMakeCorrida()
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