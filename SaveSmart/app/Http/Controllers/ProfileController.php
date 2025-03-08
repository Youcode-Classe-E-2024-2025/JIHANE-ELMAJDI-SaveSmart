<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'current_password' => ['nullable', 'required_with:new_password'],
            'new_password' => ['nullable', 'min:8', 'confirmed'],
            'photo' => ['nullable', 'image', 'max:2048', 'mimes:jpeg,png,jpg,gif'] // max 2MB
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            
            // Generate a unique filename with original extension
            $extension = $file->getClientOriginalExtension();
            $filename = 'profile_' . time() . '_' . Str::random(10) . '.' . $extension;
            
            // Store in public/storage/profiles directory
            $path = $file->storeAs('profiles', $filename, 'public');
            
            // Delete old photo if exists
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            
            $user->photo = $path;
        }

        // Update basic information
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];

        // Handle password change
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()
                    ->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.'])
                    ->withInput();
            }

            $user->password = Hash::make($validated['new_password']);
        }

        $user->save();

        return redirect()
            ->route('profile')
            ->with('success', 'Profil mis à jour avec succès.');
    }
}
