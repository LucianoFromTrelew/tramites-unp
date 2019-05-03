<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Categoria;
use App\User;

class CategoriaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample() {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function getAuthHeader() {
        $token = User::first()->generateToken();
        return [
            'Authorization' => "Bearer $token"
        ];
    }
    public function testCategoriasCreadasCorrectamente() {
        $payload = [
            'descripcion' => 'una descripcion'
        ];

        $count = Categoria::count();
        $this->json('POST', '/api/categorias', $payload, $this->getAuthHeader())
            ->assertStatus(201)
            ->assertJson(['id' => $count+1, 'descripcion' => 'una descripcion']);
    }
}
