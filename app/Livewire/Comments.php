<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Comments extends Component
{
    public $comments =[];
    
    #[On('post-created')]
    public function addComment($comment){
        //espra 1 array y 2do el elemento que quiero agreagar al array 
        array_unshift($this->comments,$comment);
    }
    #[On('post-update')]
    public function postupdate($comment){
        array_unshift($this->comments,$comment);
    }
    public function render()
    {
        return view('livewire.comments');
    }
}
