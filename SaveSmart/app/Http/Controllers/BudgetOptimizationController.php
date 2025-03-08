<?php

namespace App\Http\Controllers;

use App\Services\BudgetOptimizationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BudgetOptimizationController extends Controller
{
    protected $budgetService;

    public function __construct(BudgetOptimizationService $budgetService)
    {
        $this->budgetService = $budgetService;
    }

    public function index()
    {
        $user = Auth::user();
        $transactions = $user->transactions()
            ->with('category')
            ->whereMonth('date', now()->month)
            ->get();

        $analysis = $this->budgetService->analyzeSpending($transactions);
        $recommendations = $this->budgetService->getRecommendations($analysis);

        $monthlyIncome = $transactions->where('type', 'income')->sum('amount');
        $optimalDistribution = $this->budgetService->calculateOptimalDistribution($monthlyIncome);

        return view('budget.optimization', compact(
            'analysis',
            'recommendations',
            'monthlyIncome',
            'optimalDistribution'
        ));
    }
}