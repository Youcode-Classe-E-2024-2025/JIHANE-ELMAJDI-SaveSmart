<?php

namespace App\Http\Controllers;

use App\Models\SavingsGoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class SavingsGoalController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $goals = Auth::user()->savingsGoals()
            ->orderBy('status')
            ->orderBy('target_date')
            ->get();
        
        return view('savings.index', compact('goals'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0',
            'target_date' => 'nullable|date|after:today',
            'description' => 'nullable|string',
        ]);

        Auth::user()->savingsGoals()->create($validated);
        
        return redirect()->route('savings.index')
            ->with('success', 'Objectif d\'épargne créé avec succès');
    }

    public function update(Request $request, SavingsGoal $goal)
    {
        $this->authorize('update', $goal);
        
        $validated = $request->validate([
            'current_amount' => 'required|numeric|min:0',
        ]);

        $goal->update($validated);

        if ($goal->current_amount >= $goal->target_amount) {
            $goal->update(['status' => 'completed']);
        }

        return redirect()->back()
            ->with('success', 'Progression mise à jour avec succès');
    }

    public function cancel(SavingsGoal $goal)
    {
        $this->authorize('update', $goal);
        
        $goal->update(['status' => 'cancelled']);
        
        return redirect()->back()
            ->with('success', 'Objectif d\'épargne annulé');
    }

    public function destroy(SavingsGoal $goal)
    {
        $this->authorize('delete', $goal);
        
        $goal->delete();
        
        return redirect()->route('savings.index')
            ->with('success', 'Objectif d\'épargne supprimé');
    }
}