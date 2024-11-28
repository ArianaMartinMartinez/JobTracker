<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Offer;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OfferTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckIfCanReceiveAllOffersInJsonFile() {
        $offer = Offer::factory(5)->create();
        $response = $this->get(route('apiHomeOffers'));

        $response->assertStatus(200)
            ->assertJsonCount(5);
    }

    public function test_CheckIfCanReceiveOneOfferInJsonFile() {
        $offer = $this->post(route('apiStoreOffer'),[
            'title' => 'Título de ejemplo de API',
            'company' => 'Compañía de ejemplo de API',
            'url' => 'https://github.com/ArianaMartinMartinez',
            'status' => 'In progress',
        ]);

        $data = ['title' => 'Título de ejemplo de API'];

        $response = $this->get(route('apiShowOffer', 1));
        $response->assertStatus(200)
            ->assertJsonFragment($data);
    }

    public function test_ChecKIfCanCreateNewOfferWithApi() {
        $response = $this->post(route('apiStoreOffer'), [
            'title' => 'Título de prueba API',
            'company' => 'Compañía de prueba API',
            'url' => 'https://github.com/ArianaMartinMartinez',
            'status' => 'In progress',
        ]);

        $response = $this->get(route('apiHomeOffers'));
        $response->assertStatus(200)
            ->assertJsonCount(1);
    }

    public function test_CheckIfCanUpdateOfferWithApi() {
        $response = $this->post(route('apiStoreOffer', [
            'title' => 'Título de prueba API',
            'company' => 'Compañía de prueba API',
            'url' => 'https://github.com/ArianaMartinMartinez',
            'status' => 'In progress',
        ]));
        $data = ['company' => 'Compañía de prueba API'];

        $response = $this->get(route('apiHomeOffers'));
        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment($data);

        $response = $this->put(route('apiUpdateOffer', 1), [
            'title' => 'Título de prueba API modificado',
            'company' => 'Compañía de prueba API modificado',
            'url' => 'https://github.com/ArianaMartinMartinez',
            'status' => 'Finished',
        ]);
        $data = ['company' => 'Compañía de prueba API modificado'];

        $response = $this->get(route('apiHomeOffers'));
        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment($data);
    }

    public function test_CheckIfCanDeleteOfferWithApi() {
        $offer = Offer::factory(2)->create();

        $response = $this->delete(route('apiDestroyOffer', 1));
        $this->assertDatabaseCount('offers', 1);

        $response = $this->get(route('apiHomeOffers'));
        $response->assertStatus(200)
            ->assertJsonCount(1);
    }
}
