<?php

use App\Livewire\GamesList;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(GamesList::class)
        ->assertStatus(200);
});
