<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // 'income' or 'expense'
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });

        // Add default categories
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

        DB::table('categories')->insert($categories);

        // Add category_id to transactions table
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreignId('category_id')->after('type')->nullable()->constrained();
            // Drop the old category column
            $table->dropColumn('category');
        });
    }

    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('category')->after('type');
            $table->dropConstrainedForeignId('category_id');
        });

        Schema::dropIfExists('categories');
    }
};