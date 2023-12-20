<?php

namespace App\Livewire;

use App\Models\Point;
use App\Models\User;
use Livewire\Component;

class ScoreList extends Component {
    public $game = null;

    public function mount(?string $game) {
        $this->game = $game;
    }

    public function render() {
        $points = Point::where('is_active', true)->get();
        $list = [];

        foreach ($points as $point) {
            $game = $point->round->game;

            if($this->game != 'all') {
                if($this->game && $game->slug != $this->game) {
                    continue;
                }
            }

            if(!isset($list[$point->user_id])) {
                $list[$point->user_id] = [
                    'user' => User::find($point->user_id),
                    'rounds' => 0,
                    'points' => 0,
                ];
            }
            $list[$point->user_id]['rounds']++;
            $list[$point->user_id]['points'] += $point->points;
        }

        usort($list, function($a, $b) {
            if($a['points'] == $b['points']) {
                return 0;
            }
            return ($a['points'] > $b['points']) ? -1 : 1;
        });

        return view('livewire.score-list', [
            'list' => $list,
        ]);
    }
}
