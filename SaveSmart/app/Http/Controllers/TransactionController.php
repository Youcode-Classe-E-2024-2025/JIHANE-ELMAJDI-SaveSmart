<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        
        // Get current month's transactions with eager loading of categories
        $transactions = $user->transactions()
            ->with('category')
            ->whereYear('date', now()->year)
            ->get();

        // Calculate totals
        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpenses = $transactions->where('type', 'expense')->sum('amount');

        // Calculate expenses by category using eloquent collection
        $expensesByCategory = $transactions
            ->where('type', 'expense')
            ->groupBy(function($transaction) {
                return $transaction->category->name;
            })
            ->map(function($group) {
                return $group->sum('amount');
            });

        // Get recent transactions for the table
        $recentTransactions = $user->transactions()
            ->with('category')
            ->orderBy('date', 'desc')
            ->take(5)
            ->get();
        return view('dashboard', compact(
            'totalIncome',
            'totalExpenses',
            'expensesByCategory',
            'recentTransactions'
        ));
    }

    public function index()
    {
        $transactions = Auth::user()->transactions()
            ->with('category')
            ->orderBy('date', 'desc')
            ->get();

        $categories = Category::all();

        return view('transactions.index', compact('transactions', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:income,expense',
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);

        Auth::user()->transactions()->create($validated);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction enregistrée avec succès');
    }

    public function update(Request $request, Transaction $transaction)
    {
        $this->authorize('update', $transaction);

        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:income,expense',
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);

        $transaction->update($validated);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction mise à jour avec succès');
    }

    public function destroy(Transaction $transaction)
    {
        $this->authorize('delete', $transaction);

        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction supprimée avec succès');
    }
}