<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Tramite;
use App\Documento;
use App\User;

class TramiteTest extends TestCase
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

    public function setUp(): void {
        parent::setUp();
        $this->faker = \Faker\Factory::create();
    }

    public function getAuthHeader() {
        $token = User::first()->generateToken();
        return [
            'Authorization' => "Bearer $token"
        ];
    }

    public function testDevuelveCorrectamenteTramites() {
        $response = $this->get('/api/tramites');

        $response->assertOk()
            ->assertJsonCount(Tramite::count());
    }

    public function testDevuelveCorrectamenteTramite() {
        $tramite = Tramite::first();
        $response = $this->get("/api/tramites/$tramite->id");

        $response->assertOk()
            ->assertJson([
                'id' => $tramite->id,
                'titulo' => $tramite->titulo,
                'descripcion' => $tramite->descripcion,
                'categoria_id' => $tramite->categoria_id,
            ]);
            
    }

    public function testDevuelveLosMetodosDisponiblesCorrectamente() {
        $tramite = Tramite::first();
        $metodos_disponibles = $tramite->metodosDisponibles();
        $response = $this->get("/api/tramites/$tramite->id/metodos");

        $response->assertOk();
        foreach ($metodos_disponibles as $metodo) {
            $response->assertJsonFragment([
                'id' => $metodo->id,
                'descripcion' => $metodo->descripcion,
            ]);
        }
    }
    public function testDevuelveLosPasosPorMetodoCorrectamente() {
        $tramite = Tramite::first();
        $metodo = $tramite->metodosDisponibles()->first();
        $response = $this->get("/api/tramites/$tramite->id/pasos/$metodo->id");

        $response->assertOk();
    }

    public function testDevuelveCorrectamenteDocumentosDeUnTramite() {
        $tramite = Tramite::first();
        $documento = $tramite->documentos()->first();
        $response = $this->get("/api/tramites/$tramite->id/documentos");

        $response->assertOk()
            ->assertJsonCount($tramite->documentos()->count())
            ->assertJsonFragment([
                'id' => $documento->id,
                'descripcion' => $documento->descripcion,
            ]);
    }

    public function testDevuelveCorrectamenteRequerimientosDeUnTramite() {
        $tramite = Tramite::first();
        $requerimiento = $tramite->requerimientos()->first();
        $response = $this->get("/api/tramites/$tramite->id/requerimientos");

        $response->assertOk()
            ->assertJsonCount($tramite->requerimientos()->count())
            ->assertJsonFragment([
                'id' => $requerimiento->id,
                'descripcion' => $requerimiento->descripcion,
            ]);
    }

    public function testDevuelveCorrectamenteEtiquetasDeUnTramite() {
        $tramite = Tramite::first();
        $etiqueta = $tramite->etiquetas()->first();
        $response = $this->get("/api/tramites/$tramite->id/etiquetas");

        $response->assertOk()
            ->assertJsonCount($tramite->etiquetas()->count())
            ->assertJsonFragment([
                'id' => $etiqueta->id,
                'descripcion' => $etiqueta->descripcion,
            ]);
    }

    public function testAgregaUnDocumentoAUnTramiteCorrectamente() {
        $tramite = Tramite::first();
        $nuevo_documento = Documento::create([
            'descripcion' => $this->faker->sentence
        ]);

        $response = $this->post("/api/tramites/$tramite->id/documentos", [
            'documento_id' => $nuevo_documento->id
        ], $this->getAuthHeader());

        $response->assertStatus(201);
    }

    public function testNoAgregaDocumentosDuplicadosAUnTramite() {
        $tramite = Tramite::first();
        $nuevo_documento = Documento::create([
            'descripcion' => $this->faker->sentence
        ]);

        $response = $this->post("/api/tramites/$tramite->id/documentos", [
            'documento_id' => $nuevo_documento->id
        ], $this->getAuthHeader());

        $response->assertStatus(201);

        $another_response = $this->post("/api/tramites/$tramite->id/documentos", [
            'documento_id' => $nuevo_documento->id
        ], $this->getAuthHeader());

        $another_response->assertStatus(400);
    }

    public function testEliminaDocumentosDeUnTramiteCorrectamente() {
        $tramite = Tramite::first();
        $documento_id = $tramite->documentos()->first()->id;

        $response = $this->delete("/api/tramites/$tramite->id/documentos", [
            'documento_id' => $documento_id
        ], $this->getAuthHeader());

        $response->assertStatus(200);
    }

    public function testNoEliminaDocumentoSiNoEstaVinculadoConElTramite() {
        $tramite = Tramite::first();
        $documento_id = $tramite->documentos()->first()->id;

        $response = $this->delete("/api/tramites/$tramite->id/documentos", [
            'documento_id' => $documento_id
        ], $this->getAuthHeader());

        $response->assertStatus(200);

        $another_response = $this->delete("/api/tramites/$tramite->id/documentos", [
            'documento_id' => $documento_id
        ], $this->getAuthHeader());

        $another_response->assertStatus(400);
    }
}
