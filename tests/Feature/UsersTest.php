<?php

namespace Tests\Feature;

use App\Models\Users;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersTest extends TestCase
{
    

    public function testGetUser()
    {
        $response = $this->getJson('/api/Corridas/Usuarios');

        $response->assertStatus(200);

    }

    public function testPostUser(){
        $response = $this->postJson('/api/Corridas/Usuarios', [
            "name"=>"Testing with PHPUnit",
            "email"=>"phpunittest@gmail.com"
        ]);

        $response->assertStatus(200);
    }

    public function testDeleteUser(){

        $getLastId = Users::select('id')
            ->orderBy('id','DESC')
            ->first();

        $response = $this->deleteJson('/api/Corridas/Usuarios', [
            "id"=>$getLastId
        ]);

        $response->assertStatus(200);

    }
}
