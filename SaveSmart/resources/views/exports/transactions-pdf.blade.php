<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rapport financier SaveSmart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #831843;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            color: #9d174d;
        }
        .summary {
            margin-bottom: 30px;
            padding: 15px;
            background-color: #fdf2f8;
            border-radius: 8px;
        }
        .summary-item {
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #fbcfe8;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #fdf2f8;
            color: #9d174d;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #be185d;
            border-top: 1px solid #fbcfe8;
            padding-top: 20px;
        }
        .income { color: #be185d; }
        .expense { color: #be185d; opacity: 0.8; }
        h2 {
            color: #9d174d;
            margin-bottom: 20px;
        }
        tr:nth-child(even) {
            background-color: #fdf2f8;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Rapport Financier SaveSmart</h1>
        <p>Généré le {{ $exportDate }}</p>
    </div>

    <div class="summary">
        <div class="summary-item">
            <strong>Revenus totaux:</strong> 
            <span class="income">{{ number_format($totalIncome, 2) }} €</span>
        </div>
        <div class="summary-item">
            <strong>Dépenses totales:</strong> 
            <span class="expense">{{ number_format($totalExpenses, 2) }} €</span>
        </div>
        <div class="summary-item">
            <strong>Solde:</strong> 
            <span class="{{ $balance >= 0 ? 'income' : 'expense' }}">
                {{ number_format($balance, 2) }} €
            </span>
        </div>
    </div>

    <h2>Détail des transactions</h2>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Catégorie</th>
                <th>Montant</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->date->format('d/m/Y') }}</td>
                <td>{{ $transaction->type === 'income' ? 'Revenu' : 'Dépense' }}</td>
                <td>{{ $transaction->category->name }}</td>
                <td class="{{ $transaction->type === 'income' ? 'income' : 'expense' }}">
                    {{ number_format($transaction->amount, 2) }} €
                </td>
                <td>{{ $transaction->description ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>SaveSmart - Votre outil de gestion financière personnelle</p>
        <p>www.savesmart.com</p>
    </div>
</body>
</html>