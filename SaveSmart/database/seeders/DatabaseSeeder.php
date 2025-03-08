<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\SavingsGoal;
use App\Models\FamilyAccount;
use App\Models\FamilyMember;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create demo user
        $demoUser = User::create([
            'name' => 'Demo User',
            'email' => 'demo@example.com',
            'password' => Hash::make('password'),
        ]);

        // Create family members
        $familyMember1 = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
        ]);

        $familyMember2 = User::create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
        ]);
        
        // Create a family account
        $familyAccount = FamilyAccount::create([
            'name' => 'Famille Demo',
            'owner_id' => $demoUser->id,
        ]);

        // Add members to family account
        $familyAccount->members()->create([
            'user_id' => $demoUser->id,
            'role' => 'owner'
        ]);

        $familyMembers = [$familyMember1, $familyMember2];
        foreach ($familyMembers as $member) {
            $familyAccount->members()->create([
                'user_id' => $member->id,
                'role' => 'member'
            ]);
        }

        // Create categories if they don't exist
        if (Category::count() === 0) {
            $categories = [
                ['name' => 'Salaire', 'type' => 'income', 'is_default' => true],
                ['name' => 'Investissements', 'type' => 'income', 'is_default' => true],
                ['name' => 'Autres revenus', 'type' => 'income', 'is_default' => true],
                ['name' => 'Alimentation', 'type' => 'expense', 'is_default' => true],
                ['name' => 'Logement', 'type' => 'expense', 'is_default' => true],
                ['name' => 'Transport', 'type' => 'expense', 'is_default' => true],
                ['name' => 'Santé', 'type' => 'expense', 'is_default' => true],
                ['name' => 'Divertissement', 'type' => 'expense', 'is_default' => true],
                ['name' => 'Épargne', 'type' => 'expense', 'is_default' => true],
                ['name' => 'Éducation', 'type' => 'expense', 'is_default' => true],
            ];

            foreach ($categories as $category) {
                Category::create($category);
            }
        }

        // Create transactions for demo user
        // Regular monthly income
        $salaireCategory = Category::where('name', 'Salaire')->first();
        $months = [
            now()->startOfMonth(),
            now()->subMonth()->startOfMonth(),
            now()->subMonths(2)->startOfMonth()
        ];

        foreach ($months as $month) {
            Transaction::create([
                'user_id' => $demoUser->id,
                'amount' => 3000,
                'type' => 'income',
                'category_id' => $salaireCategory->id,
                'date' => $month->addDays(5),
                'description' => 'Salaire mensuel',
            ]);
        }

        // Create various expenses
        $expenseData = [
            ['Alimentation', 250, 'Courses hebdomadaires'],
            ['Logement', 800, 'Loyer mensuel'],
            ['Transport', 120, 'Carburant'],
            ['Santé', 150, 'Médicaments'],
            ['Divertissement', 80, 'Cinéma et restaurants'],
            ['Éducation', 200, 'Livres et fournitures'],
            ['Transport', 60, 'Transport en commun'],
            ['Alimentation', 150, 'Restaurant'],
            ['Santé', 300, 'Consultation médicale'],
            ['Divertissement', 100, 'Abonnement streaming'],
            ['Logement', 150, 'Facture électricité'],
            ['Logement', 80, 'Facture eau'],
            ['Transport', 40, 'Parking'],
            ['Alimentation', 180, 'Courses'],
            ['Divertissement', 75, 'Concert']
        ];

        foreach ($expenseData as $expense) {
            Transaction::create([
                'user_id' => $demoUser->id,
                'amount' => $expense[1],
                'type' => 'expense',
                'category_id' => Category::where('name', $expense[0])->first()->id,
                'date' => now()->subDays(rand(0, 90)),
                'description' => $expense[2],
            ]);
        }

        // Create savings goals
        SavingsGoal::create([
            'user_id' => $demoUser->id,
            'name' => 'Vacances d\'été',
            'target_amount' => 2000,
            'current_amount' => 800,
            'target_date' => now()->addMonths(4),
            'description' => 'Économies pour les vacances en famille',
            'status' => 'in_progress',
        ]);

        SavingsGoal::create([
            'user_id' => $demoUser->id,
            'name' => 'Fond d\'urgence',
            'target_amount' => 5000,
            'current_amount' => 1500,
            'target_date' => now()->addYear(),
            'description' => 'Fond de sécurité pour les imprévus',
            'status' => 'in_progress',
        ]);
    }
}
