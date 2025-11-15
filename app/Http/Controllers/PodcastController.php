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
        Gate::authorize('gerer_podcasts');

        $request->validate([
            'titre' => 'required|string|max:255',
            'categorie' => 'required|string|max:255',
            'animateur' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'sometimes|string',
        ]);

        $podcast = Podcast::create([
            'titre' => $request->titre,
            'categorie' => $request->categorie,
            'animateur' => $request->animateur,
            'description' => $request->description,
            'image' => $request->image,
            'user_id' => auth()->id(),
        ]);

        return response()->json($podcast);

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
        Gate::authorize('gerer_podcasts', $podcast); 

        $request->validate([
            'titre' => 'sometimes|string|max:255',
            'categorie' => 'sometimes|string|max:255',
            'animateur' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'image' => 'sometimes|string', 
        ]);
         $podcast->update($request->only([
        'titre',
        'categorie',
        'animateur',
        'description',
        'image',
    ]));

    return response()->json($podcast);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Podcast $podcast)
    {
        Gate::authorize('gerer_podcasts', $podcast); 

        $podcast->delete();
        return response()->json(['message' => 'Podcast supprimé']);
    }
    
}
