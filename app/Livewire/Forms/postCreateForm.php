<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class postCreateForm extends Form
{
    #[Rule('required|min:3')]
    public $title;
     #[Rule('required')]
    public $content;
     #[Rule('required')]
    public $category_id = '';
     #[Rule('required|array')]
    public $tags = [];

    public $image;

    public function save(){
        $this->validate();

        $post = Post::create(
            $this->only('title', 'content','category_id')
        );
        $post->tags()->attach($this->tags);

        if($this->image){
            // // nombre de carpeta donde se almacena store(post)
           $post->image_path= $this->image->store('posts');
        }
        $post->save();

        // $this->reset(['title', 'category_id', 'content', 'selectedTags']);
        $this->reset();

    }
}


