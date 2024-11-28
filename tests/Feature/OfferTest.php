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
}
