<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Categoria;

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

    public function testCategoriasCreadasCorrectamente() {
        $payload = [
            'descripcion' => 'una descripcion'
        ];

        $this->json('POST', '/api/categorias', $payload)
            ->assertStatus(201)
            // En el seeder creo 50 categorias, asi que aca espero la 51
            ->assertJson(['id' => 51, 'descripcion' => 'una descripcion']);
    }

    public function testCategoriaDevuelveSubcategorias() {
        $subcategorias = array();
        foreach (Categoria::find(1)->subcategorias() as $sc) {
            array_push($subcategorias, $sc);
        }

        $this->json('GET', '/api/categorias/1/subcategorias')
            ->assertStatus(200)
            ->assertJson($subcategorias);
    }
}
