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
        $offers = Offer::with('lastestProgress')->get();

        return view('home', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('createOffer');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'company' => 'required',
            'url' => 'required',
            'status' => 'required',
        ]);

        $offer = Offer::create([
            'title' => $request->title,
            'company' => $request->company,
            'url' => $request->url,
            'status' => $request->status == 'progress' ? 'In progress' : $request->status,
        ]);

        $offer->save();

        return redirect()->route('home');
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
