<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'is_active'
    ];

    public function rounds() {
        return $this->hasMany(Round::class);
    }
}
