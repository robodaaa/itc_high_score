<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'is_active',
    ];

    public function game() {
        return $this->belongsTo(Game::class);
    }

    public function points() {
        return $this->hasMany(Point::class);
    }
}
