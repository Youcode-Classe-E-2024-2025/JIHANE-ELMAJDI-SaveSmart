<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyAccount extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'owner_id'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function members()
    {
        return $this->hasMany(FamilyMember::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'family_members');
    }

    public function transactions()
    {
        return $this->hasManyThrough(Transaction::class, FamilyMember::class, 'family_account_id', 'user_id', 'id', 'user_id');
    }
}