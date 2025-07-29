<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class postEditForm extends Form
{
    public $postId = '';
    public $open = false;
    //
    #[Rule('required')]
    public $title;
    #[Rule('required')]
    public $content;
    #[Rule('required')]
    public $category_id = '';
    #[Rule('required|array')]
    public $tags = [];

    public function edit($postId)
    {
        $this->open = true;
        $this->postId = $postId;

        $post = Post::find($postId);
        $this->category_id = $post->category_id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->tags = $post->tags->pluck('id')->toArray();
    }
    
    public function update()
    {
        $this->validate();
        $post = Post::find($this->postId);
        // $post->update([
        //     'category_id' => $this->postEdit['category_id'],
        //     'title' => $this->postEdit['title'],
        //     'content' => $this->postEdit['content'],
        // ]);
        $post ->update(
            $this->only('category_id','title','content',)
        );

        $post->tags()->sync($this->tags);
        $this->reset(['postEdit', 'postEditId', 'open']);
        
    }
}
