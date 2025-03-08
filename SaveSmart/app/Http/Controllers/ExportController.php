<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;
use PDF;

class ExportController extends Controller
{
    public function exportCsv(Request $request)
    {
        $transactions = Auth::user()->transactions()
            ->with('category')
            ->orderBy('date', 'desc')
            ->get();

        $filename = 'transactions_' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($transactions) {
            $file = fopen('php://output', 'w');
            
            // CSV
            fputcsv($file, [
                'Date',
                'Type',
                'Catégorie',
                'Montant',
                'Description'
            ]);

            // Données
            foreach ($transactions as $transaction) {
                fputcsv($file, [
                    $transaction->date->format('d/m/Y'),
                    $transaction->type === 'income' ? 'Revenu' : 'Dépense',
                    $transaction->category->name,
                    $transaction->amount,
                    $transaction->description ?? ''
                ]);
            }

            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }

    public function exportPdf()
    {
        $user = Auth::user();
        $transactions = $user->transactions()
            ->with('category')
            ->orderBy('date', 'desc')
            ->get();

        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpenses = $transactions->where('type', 'expense')->sum('amount');
        
        $data = [
            'transactions' => $transactions,
            'totalIncome' => $totalIncome,
            'totalExpenses' => $totalExpenses,
            'balance' => $totalIncome - $totalExpenses,
            'exportDate' => now()->format('d/m/Y')
        ];

        $pdf = PDF::loadView('exports.transactions-pdf', $data);
        
        return $pdf->download('transactions_' . now()->format('Y-m-d') . '.pdf');
    }
}