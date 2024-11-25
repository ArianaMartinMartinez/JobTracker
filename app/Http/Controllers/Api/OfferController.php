<?php

namespace App\Http\Controllers\Api;

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
        return response()->json($offers, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $offer = Offer::create([
           'title' => $request->title,
           'company' => $request->company,
           'url' => $request->url,
           'status' => $request->status, 
        ]);

        $offer->save();

        return response()->json($offer, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $offer = Offer::with('progress')->find($id);
        return response()->json($offer, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $offer = Offer::find($id);

        $offer->update([
            'title' => $request->title,
            'company' => $request->company,
            'url' => $request->url,
            'status' => $request->status,
        ]);
        $offer->save();

        return response()->json($offer, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $offer = Offer::find($id);
        $offer->delete();
    }
}
