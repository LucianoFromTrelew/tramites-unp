<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Categoria;
use App\Subcategoria;

class SubcategoriaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testSubcategoriaNoPuedeSerCreadaConCategoriaIdQueNoExista() {
        $payload = [
            'descripcion' => 'una descripcion',
            'categoria_id' => 1000
        ];

        $this->json('POST', '/api/subcategorias', $payload)
            ->assertStatus(500);
    }

    public function testSubcategoriaSeCreaCorrectamente() {
        $payload = [
            'descripcion' => 'una descripcion',
            'categoria_id' => 1
        ];

        $this->json('POST', '/api/subcategorias', $payload)
            ->assertStatus(201)
            ->assertJson([
                'descripcion' => 'una descripcion',
                'categoria_id' => 1
            ]);
    }
}
