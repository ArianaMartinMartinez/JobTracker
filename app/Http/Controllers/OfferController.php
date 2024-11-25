<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offers = Offer::all();

        return view('home', compact('offers'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $offer = Offer::with('progresses')->findOrFail($id);
        return view('show', compact('offer'));
    }
}
