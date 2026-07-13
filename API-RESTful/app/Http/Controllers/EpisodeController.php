<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEpisodeRequest;
use App\Http\Requests\UpdateEpisodeRequest;
use App\Models\Episode;
use App\Models\Podcast;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Episode",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Épisode 1"),
 *     @OA\Property(property="description", type="string", example="Description"),
 *     @OA\Property(property="audio", type="string", example="https://res.cloudinary.com/.../audio.mp3"),
 *     @OA\Property(property="podcast_id", type="integer", example=1)
 * )
 */

class EpisodeController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/podcasts/{podcast_id}/episodes",
     *     summary="Liste des épisodes d'un podcast",
     *     tags={"Episodes"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="podcast_id",
     *         in="path",
     *         required=true,
     *         description="ID du podcast",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Liste des épisodes",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Episode")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Podcast introuvable"),
     *     @OA\Response(response=401, description="Non authentifié")
     * )
     */
    public function index($podcast_id)
    {
        $podcast = Podcast::findOrFail($podcast_id);
        $this->authorize('viewAny', Episode::class);

        $episodes = Episode::where('podcast_id', $podcast_id)->get();

        return response()->json($episodes, 200);
    }

    /**
     
     */
    public function store(StoreEpisodeRequest $request)
    {
        $this->authorize('create', Episode::class);

        // Vérifier que l'animateur est propriétaire du podcast (sauf admin)
        if ($request->user()->role !== 'administrateur') {
            $podcast = Podcast::findOrFail($request->podcast_id);
            if ($podcast->user_id !== $request->user()->id) {
                return response()->json(['message' => 'Accès refusé : vous n\'êtes pas propriétaire de ce podcast'], 403);
            }
        }

        $infos = $request->validated();

        if ($request->hasFile('audio')) {
            $filePath = $request->file('audio')->getRealPath();
            $uploadedAudio = Cloudinary::upload($filePath, [
                'resource_type' => 'video',
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
    
     */
    public function show($id)
    {
        $episode = Episode::with('podcast.user')->findOrFail($id);
        $this->authorize('view', $episode);

        return response()->json($episode, 200);
    }

    /**
     
     */
    public function update(UpdateEpisodeRequest $request, Episode $episode)
    {
        $this->authorize('update', $episode);

        $infos = $request->validated();

        if ($request->hasFile('audio')) {
            $filePath = $request->file('audio')->getRealPath();
            $uploadedAudio = Cloudinary::upload($filePath, [
                'resource_type' => 'video',
            ])->getSecurePath();
            $infos['audio'] = $uploadedAudio;
        }

        $episode->update($infos);

        return response()->json([
            'message' => 'Épisode modifié avec succès',
            'episode' => $episode,
        ], 200);
    }

    /**
    
     */
    public function destroy(Episode $episode)
    {
        $this->authorize('delete', $episode);

        $episode->delete();

        return response()->json([
            'message' => 'Épisode supprimé avec succès',
        ], 200);
    }

    /**
    
     */
   
}