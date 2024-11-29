<?php

namespace App\Http\Controllers\Api;

use App\Models\Offer;
use App\Models\Progress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $progresses = Progress::all();
        return response()->json($progresses, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $offerId)
    {
        $validated = $request->validate([
            'comment' => 'required | array',
        ]);
        
        $offer = Offer::find($offerId);
        if(!$offer) {
            return response()->json([
                'message' => 'The offer where you want to insert progress does not exists',
            ], 404);
        }

        $progressData = collect($validated['comment'])->map(function($commentItem) use ($offer) {
            return [
                'comment' => $commentItem,
                'id_offer' => $offer->id,
            ];
        });

        $offer->progresses()->createMany($progressData);

        return response()->json([
            'message' => 'Progress added',
            'offer' => $offer->load('progresses'),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $progress = Progress::findOrFail($id);
        return response()->json($progress, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $progress = Progress::find($id);

        $progress->update([
            'comment' => $request->comment,
            'id_offer' => $request->id_offer,
        ]);

        $progress->save();

        return response()->json($progress, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $progress = Progress::find($id);
        $progress->delete();
    }
}
