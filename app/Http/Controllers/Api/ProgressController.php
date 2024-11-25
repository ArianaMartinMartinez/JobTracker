<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Progress;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $progress = Progress::create([
            'comment' => $request->comment,
            'id_offer' => $request->id_offer,
        ]);

        $progress->save();

        return response()->json($progress, 200);
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
