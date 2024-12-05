<?php

namespace Tests\Feature;

use App\Models\Offer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OfferTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckIfCanReceiveAllOffersInView() {
       $this->withoutExceptionHandling();

       Offer::all();

       $response = $this->get('/');

       $response->assertStatus(200)
            ->assertViewIs('home');
    }

    public function test_CheckIfCanReceiveOnOfferInView() {
        $this->withoutExceptionHandling();

        $offer = Offer::factory()->create([
            'title' => 'Título de ejemplo',
            'company' => 'Compañía de ejemplo',
            'url' => 'https://github.com/ArianaMartinMartinez',
            'status' => 'In progress',
        ]);

        $response = $this->get('/offers/' . $offer->id);

        $response->assertStatus(200)
            ->assertViewIs('show')
            ->assertViewHas('offer', $offer);
    }

    public function test_CheckIfCanCreateNewOfferInView() {
        $this->withoutExceptionHandling();

        $response = $this->get(route('createOffer'));
        $response->assertStatus(200)
            ->assertViewIs('createOffer');
        
        $response = $this->post(route('storeOffer'), [
            'title' => 'Título de ejemplo de web',
            'company' => 'Compañía de ejemplo de web',
            'url' => 'https://github.com/ArianaMartinMartinez',
            'status' => 'progress',
        ]);

        $this->assertDatabaseCount('offers', 1);

        $response->assertStatus(302)
            ->assertRedirectToRoute('home');
    }
}
