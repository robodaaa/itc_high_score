<?php

use App\Livewire\ScoreList;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ScoreList::class)
        ->assertStatus(200);
});
