<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Tramite;
use App\Documento;
use App\Requerimiento;
use App\Etiqueta;
use App\Metodo;

class TramiteTest extends TestCase
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

    public function setUp(): void {
        parent::setUp();
        // Conseguimos un tramite que tenga documentos,
        // etiquetas, y requerimientos asociados
        $this->tramite = Tramite::has('documentos')
            ->has('etiquetas')
            ->has('requerimientos')
            ->get()[0];
    }

    public function testTramiteTieneDocumentos() {
        $this->assertNotEmpty($this->tramite->documentos);
    }

    public function testTramiteTieneRequerimientos() {
        $this->assertNotEmpty($this->tramite->requerimientos);
    }

    public function testTramiteTieneEtiquetas() {
        $this->assertNotEmpty($this->tramite->etiquetas);
    }

    public function testBorraEnCascada() {
        Documento::all()->each->delete();
        Requerimiento::all()->each->delete();
        Etiqueta::all()->each->delete();
        $this->assertEmpty($this->tramite->documentos);
        $this->assertEmpty($this->tramite->requerimientos);
        $this->assertEmpty($this->tramite->etiquetas);
    }

    public function testDevuelvePasosCorrectamente() {
        $pasos = $this->tramite->pasos;
        $metodo = Metodo::find(3);
        $this->assertEquals(
            $pasos->where('metodo_id', '=', 3),
            $this->tramite->pasosPorMetodo($metodo)
        );
    }
}
