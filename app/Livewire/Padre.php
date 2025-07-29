<?php

namespace App\Livewire;

use Livewire\Component;

class Padre extends Component
{
    public $saludo="holaaaaaaaaaaa";

    public function redirigir(){
        return $this->redirect('/prueba',navigate:true);
    }
    public function render()
    {
        return view('livewire.padre');
    }
}
