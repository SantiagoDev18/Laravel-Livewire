<?php

namespace App\Livewire;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class Hijo extends Component
{
    // public $hola ="saludo";
    #[Reactive]
    public $saludando;

    public function render()
    {
        return view('livewire.hijo');
    }
}
