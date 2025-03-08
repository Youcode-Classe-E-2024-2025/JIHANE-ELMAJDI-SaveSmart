<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'photo', 'phone'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function ownedFamilyAccounts()
    {
        return $this->hasMany(FamilyAccount::class, 'owner_id');
    }

    public function familyMemberships()
    {
        return $this->hasMany(FamilyMember::class);
    }

    public function familyAccounts()
    {
        return $this->belongsToMany(FamilyAccount::class, 'family_members')
            ->withPivot('role')
            ->withTimestamps();
    }

    public function savingsGoals()
    {
        return $this->hasMany(SavingsGoal::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}

