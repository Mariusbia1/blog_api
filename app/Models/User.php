<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;  // ← IMPORTANT : ajouter cet import

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;  // ← Ajouter HasApiTokens ici

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Un utilisateur peut avoir plusieurs blogs
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
