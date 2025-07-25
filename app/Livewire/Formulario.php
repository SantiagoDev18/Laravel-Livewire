<?php

namespace App\Livewire;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Formulario extends Component
{
     //tenemos que enlazar estas propiedades con los input, check
    public $categories,$tags;

    #[Rule('required',message:'este mensaje personalizado')]//esta regla se aplica a la propiedad $title
    public $title;
    #[Rule('required')]
    public $content;
    #[Rule('required|exists:categories,id',as:'Categoria')]
    public $category_id = '';
    #[Rule('required|array')]
    public $selectedTags = [];

    public $post;
    public $open = false;
    public $postEditId='';
    public $postEdit=[
        //soncrnizamos cada uno en cada uno de los input,textarea.....
        'category_id'=> '',
        'title'=>'',
        'content'=>'',
        'selectedTags'=> []
    ];
    public function mount()
    {
        //metodo que utilizamos para recuperar la informacion que mandamos al componente
        //este metodo se ejecuta ni bien renderizo el componente
        //este metodo es inicial para recuperar la informacion que querramos mostrar 

        $this->categories = Category::all();
        $this->tags = Tag::all();
        $this->post = Post::all();
        
    }
    public function save()
    {
        // dd('prueba');
        // dd([
        //     'category_id'=>$this->category_id,
        //     'title'=>$this->title,
        //     'content' => $this->content,
        //     'tags' => $this->selectedTags
        // ]);

        // $post=Post::create([
        //     'category_id' => $this->category_id,
        //     'title' => $this->title,
        //     'content' =>$this->content
        // ]);
        // $this->validate([
        //     //primero coloca las reglas
        //     'title'=> 'required',
        //     'content'=> 'required',
        //     'category_id'=>'required'
        // ],[
        //     //2do los mensajes 
        //     'title.required' =>'aqui estamos cambiando el contenido '
        // ],[
        //     //3ro los atributos 
        //     'category_id'=>'categoria'
        // ]);

        $this->validate();
        $post = Post::create(
            $this->only('category_id', 'title', 'content')
        );

        $post->tags()->attach($this->selectedTags);
        $this->reset(['title', 'category_id', 'content', 'selectedTags']);
        $this->post = Post::all();
    }
    

    public function edit($postId){
        $this->postEditId=$postId;
        $this->open=true;
        $post=Post::find($postId);
        $this->postEdit['category_id']=$post->category_id;
        $this->postEdit['title']=$post->title;
        $this->postEdit['content']=$post->content;

        $this->postEdit['selectedTags']=$post->tags->pluck('id')->toArray();

    }

    public function update(){
        $post= Post::find($this->postEditId);
        $post->update([
            'category_id' =>$this->postEdit['category_id'],
            'title' =>$this->postEdit['title'],
            'content' =>$this->postEdit['content'],
        ]);

        $post->tags()->sync($this->selectedTags);
        $this->reset(['postEdit','postEditId','open']);
        $this->post = Post::all();

    }

    public function destroy($id){
        $post = Post::find($id);
        $post->delete();
        $this->post = Post::all();
    }
    public function render()
    {
        return view('livewire.formulario');
    }
}
