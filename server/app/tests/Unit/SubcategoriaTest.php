<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Categoria;
use App\Subcategoria;

class SubcategoriaTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testSubcategoriaTieneUnaCategoria() {
        $subcategoria = Subcategoria::create([
            'descripcion' => 'una descripcion',
            'categoria_id' => 1
        ]);

        $categoria = Categoria::find(1);
        $this->assertEquals($subcategoria->categoria, $categoria);
    }

    public function testSubcategoriaBorraEnCascada() {
        foreach (Categoria::all() as $categoria) {
           $categoria->delete(); 
        }
        $this->assertEmpty(Subcategoria::all());
    }
}
