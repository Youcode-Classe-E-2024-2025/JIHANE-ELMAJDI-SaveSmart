<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Inscription avec gestion de la famille
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'family_name' => 'nullable|string|max:255',
        ]);

        // Vérifier si la famille existe ou en créer une
        $family = null;
        if ($request->family_name) {
            $family = Family::firstOrCreate(['name' => $request->family_name]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'family_id' => $family?->id,
        ]);

        return response()->json(['message' => 'Utilisateur inscrit avec succès!', 'user' => $user], 201);
    }

    // Connexion
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['Les identifiants sont incorrects.'],
            ]);
        }

        return response()->json(['message' => 'Connexion réussie!', 'user' => Auth::user()]);
    }

    // Déconnexion
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Déconnexion réussie!']);
    }
}
