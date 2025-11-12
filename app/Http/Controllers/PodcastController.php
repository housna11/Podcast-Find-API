<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use App\Http\Requests\StorePodcastRequest;
use App\Http\Requests\UpdatePodcastRequest;

class PodcastController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Podcast::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePodcastRequest $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $podcast = Podcast::findOrFail($id);
        return response()->json($podcast);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePodcastRequest $request, Podcast $podcast)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Podcast $podcast)
    {
        //
    }
}
