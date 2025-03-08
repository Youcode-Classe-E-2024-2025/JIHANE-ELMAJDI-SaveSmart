<?php

namespace App\Services;

use App\Models\Transaction;
use Illuminate\Support\Collection;

class BudgetOptimizationService
{
    const NEEDS_PERCENTAGE = 50;
    const WANTS_PERCENTAGE = 30;
    const SAVINGS_PERCENTAGE = 20;

    public function calculateOptimalDistribution(float $totalIncome): array
    {
        return [
            'needs' => $totalIncome * (self::NEEDS_PERCENTAGE / 100),
            'wants' => $totalIncome * (self::WANTS_PERCENTAGE / 100),
            'savings' => $totalIncome * (self::SAVINGS_PERCENTAGE / 100),
        ];
    }

    public function analyzeSpending(Collection $transactions): array
    {
        $needsCategories = ['Alimentation', 'Logement', 'Transport', 'Santé'];
        $wantsCategories = ['Divertissement', 'Shopping', 'Loisirs'];
        $savingsCategories = ['Épargne', 'Investissements'];

        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        
        $spending = [
            'needs' => $transactions->whereIn('category.name', $needsCategories)
                                  ->where('type', 'expense')
                                  ->sum('amount'),
            'wants' => $transactions->whereIn('category.name', $wantsCategories)
                                  ->where('type', 'expense')
                                  ->sum('amount'),
            'savings' => $transactions->whereIn('category.name', $savingsCategories)
                                    ->where('type', 'expense')
                                    ->sum('amount'),
        ];

        $optimal = $this->calculateOptimalDistribution($totalIncome);
        
        return [
            'current' => $spending,
            'optimal' => $optimal,
            'differences' => [
                'needs' => $optimal['needs'] - $spending['needs'],
                'wants' => $optimal['wants'] - $spending['wants'],
                'savings' => $optimal['savings'] - $spending['savings'],
            ],
        ];
    }

    public function getRecommendations(array $analysis): array
    {
        $recommendations = [];
        
        foreach (['needs', 'wants', 'savings'] as $category) {
            $diff = $analysis['differences'][$category];
            $current = $analysis['current'][$category];
            $optimal = $analysis['optimal'][$category];
            
            if ($diff < 0) {
                $recommendations[] = [
                    'category' => $category,
                    'type' => 'reduction',
                    'message' => sprintf(
                        'Réduisez vos dépenses en %s de %.2f€ pour atteindre l\'objectif de %.2f€',
                        $this->getCategoryLabel($category),
                        abs($diff),
                        $optimal
                    )
                ];
            } elseif ($diff > 0 && $category !== 'savings') {
                $recommendations[] = [
                    'category' => $category,
                    'type' => 'info',
                    'message' => sprintf(
                        'Vous êtes en dessous du budget recommandé pour %s de %.2f€',
                        $this->getCategoryLabel($category),
                        $diff
                    )
                ];
            }
        }

        return $recommendations;
    }

    private function getCategoryLabel(string $category): string
    {
        return [
            'needs' => 'besoins essentiels',
            'wants' => 'dépenses non essentielles',
            'savings' => 'épargne'
        ][$category];
    }
}