<?php

namespace Tests\Feature\Api;

use App\Models\Offer;
use App\Models\Progress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProgressTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckIfCanReceiveAllProgressInJsonFile() {
        $offer = Offer::factory(10)->create();
        $progress = Progress::factory(5)->create();
        $response = $this->get(route('apiHomeProgresses'));

        $response->assertStatus(200)
            ->assertJsonCount(5);
    }

    public function test_CheckIfCanReceiveOneProgressInJsonFile() {
        $offer = Offer::factory(1)->create();
        $progress = $this->post(route('apiStoreProgress', 1),[
            'comment' => ['Esto es un progreso de ejemplo'],
        ]);

        $data = ['comment' => 'Esto es un progreso de ejemplo'];

        $response = $this->get(route('apiShowProgress', 1));
        $response->assertStatus(200)
            ->assertJsonFragment($data);
    }

    public function test_ChecKIfCanCreateNewProgressWithApi() {
        $offer = Offer::factory(1)->create();
        $response = $this->post(route('apiStoreProgress', 1), [
            'comment' => ['Esto es un progreso de ejemplo'],
        ]);
        $data = ['comment' => 'Esto es un progreso de ejemplo'];

        $response = $this->get(route('apiHomeProgresses'));
        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment($data);
    }

    public function test_CheckIfTryCreateNewProgressInNonexistentOfferWithApi() {
        $offer = Offer::factory(1)->create();
        $response = $this->post(route('apiStoreProgress', 40), [
            'comment' => ['Esto debería fallar'],
        ]);
        $data = ['The offer where you want to insert progress does not exists'];

        $response->assertStatus(404)
            ->assertJsonCount(1)
            ->assertJsonFragment($data);
    }

    public function test_CheckIfCanUpdateProgressWithApi() {
        $offer = Offer::factory(1)->create();
        $response = $this->post(route('apiStoreProgress', 1), [
            'comment' => ['Esto es un progreso de ejemplo'],
        ]);
        $data = ['comment' => 'Esto es un progreso de ejemplo'];

        $response = $this->get(route('apiHomeProgresses'));
        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment($data);

        $response = $this->put(route('apiUpdateProgress', 1), [
            'comment' => 'Esto es un progreso de ejemplo modificado',
            'id_offer' => 1,
        ]);
        $data = ['comment' => 'Esto es un progreso de ejemplo modificado'];

        $response = $this->get(route('apiHomeProgresses'));
        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment($data);
    }

    public function test_CheckIfCanDeleteProgressWithApi() {
        $offer = Offer::factory(1)->create();
        $progress = Progress::factory(2)->create();

        $response = $this->delete(route('apiDestroyProgress', 1));
        $this->assertDatabaseCount('progress', 1);

        $response = $this->get(route('apiHomeProgresses'));
        $response->assertStatus(200)
            ->assertJsonCount(1);
    }
}
