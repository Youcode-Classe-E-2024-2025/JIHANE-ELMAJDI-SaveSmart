<?php

namespace App\Http\Controllers;

use App\Models\FamilyAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class FamilyAccountController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $familyAccounts = Auth::user()->familyAccounts;
        return view('family.index', compact('familyAccounts'));
    }

    public function create()
    {
        return view('family.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $familyAccount = FamilyAccount::create([
            'name' => $validated['name'],
            'owner_id' => Auth::id(),
        ]);

        $familyAccount->members()->create([
            'user_id' => Auth::id(),
            'role' => 'owner'
        ]);

        return redirect()->route('family.show', $familyAccount)
            ->with('success', 'Compte familial créé avec succès');
    }

    public function show(FamilyAccount $familyAccount)
    {
        $this->authorize('view', $familyAccount);
        $members = $familyAccount->users()->get();
        $transactions = $familyAccount->transactions()
            ->orderBy('date', 'desc')
            ->paginate(10);
        
        return view('family.show', compact('familyAccount', 'members', 'transactions'));
    }

    public function addMember(Request $request, FamilyAccount $familyAccount)
    {
        $this->authorize('manage', $familyAccount);
        
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $validated['email'])->first();
        
        if ($familyAccount->users()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'Cet utilisateur est déjà membre du compte familial');
        }

        $familyAccount->members()->create([
            'user_id' => $user->id,
            'role' => 'member'
        ]);

        return back()->with('success', 'Membre ajouté avec succès');
    }

    public function removeMember(FamilyAccount $familyAccount, User $user)
    {
        $this->authorize('manage', $familyAccount);

        if ($user->id === $familyAccount->owner_id) {
            return back()->with('error', 'Impossible de retirer le propriétaire du compte');
        }

        $familyAccount->members()->where('user_id', $user->id)->delete();
        return back()->with('success', 'Membre retiré avec succès');
    }
}