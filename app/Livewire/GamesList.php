<?php

namespace App\Livewire;

use App\Models\Game;
use Livewire\Component;

class GamesList extends Component {
    public $selected = null;

    public function mount(?string $game) {
        $this->selected = $game;
    }

    public function render() {
        $games = Game::where('is_active', true)->get();
        return view('livewire.games-list', [
            'games' => $games,
        ]);
    }
}
