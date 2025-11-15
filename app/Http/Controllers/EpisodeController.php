<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Podcast;

use App\Http\Requests\StoreEpisodeRequest;
use App\Http\Requests\UpdateEpisodeRequest;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($podcast_id)
    {
        $episodes = Episode::where('podcast_id', $podcast_id)->get();
        return response()->json($episodes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEpisodeRequest $request)
    {
        if ($request->user()->role !== 'administrateur') {
            $podcast = Podcast::findOrFail($request->podcast_id);
            if (!Gate::allows('own-podcast', $podcast)) {
                return response()->json(['message' => 'Accès refusé : vous n\'êtes pas propriétaire de ce podcast'], 403);
            }
        }

        $infos = $request->validated();

        if ($request->hasFile('audio')) {
            $filePath = $request->file('audio')->getRealPath();
            $uploadedAudio = Cloudinary::upload($filePath, [
                'resource_type' => 'video'
            ])->getSecurePath();
            $infos['audio'] = $uploadedAudio;
        }

        $episode = Episode::create($infos);

        return response()->json([
            'message' => 'Épisode créé avec succès',
            'episode' => $episode,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $episode = Episode::findOrFail($id);
        return response()->json($episode);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEpisodeRequest $request, Episode $episode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Episode $episode)
    {
        //
    }
}
