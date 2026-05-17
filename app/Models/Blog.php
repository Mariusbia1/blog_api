<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    // Champs qu'on autorise à remplir en masse
    protected $fillable = [
        'user_id',
        'title',
        'content',
    ];

    // Relation : un blog appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
