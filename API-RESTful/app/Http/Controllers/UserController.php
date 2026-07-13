<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;




class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('gerer_users');
        return response()->json(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {

        Gate::authorize('gerer_users');

        $validated = $request->validated();
        $user = User::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return response()->json([
            'message' => 'Utilisateur créé avec succès',
            'user' => $user
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {try{
         Gate::authorize('gerer_users');
         $user = User::findOrFail($id);

        $request->validate([
            'nom' => 'sometimes|string|max:255',
            'prenom' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,'. $user->id,
            'password' => 'sometimes|string|min:6',
            'role' => 'sometimes|in:administrateur,animateur,utilisateur',
        ]);

        $utilisateur=$user->update($request->all());

        return response()->json([
            "message"=>"bien ete modifier","user"=>$user
        ]);
    }catch(Exeption $e){
         return response()->json([
            "message"=>$e->message()
        ]);
    }
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        Gate::authorize('gerer_users');
        $user->delete();

        return response()->json(['message' => 'Utilisateur supprimé']);
    }

    public function indexHosts()
    {
    $hosts = User::where('role', 'animateur')->get();

    return response()->json($hosts);
    }

    public function showHost($id)
    {
    $host = User::where('role', 'animateur')->findOrFail($id);

    return response()->json($host);
    }


}
