<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller {

    public function game($slug) {
        $game = Game::where('slug', $slug)->firstOrFail();
        return view('game', [
            'game' => $game,
        ]);
    }
}
