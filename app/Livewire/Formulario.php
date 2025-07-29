<?php

namespace App\Livewire;

use App\Livewire\Forms\postCreateForm;
use App\Livewire\Forms\postEditForm;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

use function Livewire\Volt\title;
use function Pest\Laravel\post;

class Formulario extends Component
{
    use WithFileUploads;
    use WithPagination;
    //tenemos que enlazar estas propiedades con los input, check
    public $categories, $tags;
    public $title;

    // #[Rule('required',message:'este mensaje personalizado')]//esta regla se aplica a la propiedad $title
    // public $title;
    // #[Rule('required')]
    // public $content;
    // #[Rule('required|exists:categories,id',as:'Categoria')]
    // public $category_id = '';
    // #[Rule('required|array')]
    // public $selectedTags = [];

    // public $post;
    public $open = false;
    public $postEditId = '';

    // #[Rule([
    //     'postCreate.title' => 'required',
    //     'postCreate.content'=> 'required',
    //     'postCreate.category_id' => 'required',
    //     'postCreate.tags' => 'required|array'
    // ],[],[
    //     'postCreate.category_id' => 'Categoria'
    // ])]
    // public $postCreate = [
    //     'title'=> '',
    //     'content'=>'',
    //     'category_id' => '',
    //     'tags'=>[]
    // ];
    public postCreateForm $postCreate;
    public postEditForm $postEdit;

    // public $postEdit=[
    //     //soncrnizamos cada uno en cada uno de los input,textarea.....
    //     'category_id'=> '',
    //     'title'=>'',
    //     'content'=>'',
    //     'selectedTags'=> []
    // ];
    // reglas generales
    // public function rules(){

    //     return [
    //     'postCreate.title' => 'required',
    //     'postCreate.content'=> 'required',
    //     'postCreate.category_id' => 'required',
    //     'postCreate.tags' => 'required|array'
    //     ];
    // }
    // public function messages(){
    //     return [
    //         'postCreate.title.required'=> 'xxxxxxxxxx'
    //     ];
    // }
    // public function validationAttributes(){
    //     return [

    //         'postCreate.category_id' => 'categoria'
    //     ];
    // }

    public function mount()
    {
        //metodo que utilizamos para recuperar la informacion que mandamos al componente
        //este metodo se ejecuta ni bien renderizo el componente
        //este metodo es inicial para recuperar la informacion que querramos mostrar

        $this->categories = Category::all();
        $this->tags = Tag::all();
        // $this->post = Post::all();

    }

    // public function updating($property, $value){
    //     dd($value);
    //     if($property == 'postCreate.category_id'){
    //         if ($value > 3) {
    //             throw new \Exception("No puedes seleccionar esta categoria");
    //         }

    //     }
    // }
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

        $this->postCreate->save(); //ejecuta la funcion save de createpostform
        //todo lo de abajo paso al form create
        // $post = Post::create(
        //     $this->postCreate->only('title', 'content','category_id')
        // );

        // $post->tags()->attach($this->postCreate->tags);
        // // $this->reset(['title', 'category_id', 'content', 'selectedTags']);
        // $this->postCreate->reset();
        // $this->post = Post::all();

        //un evento que va ser escuchado desde cualquier componente que se este ejecutando
        // dd($this->postCreate->title);

        $this->resetPage(pageName: 'pagePost'); //para que el paginador regrese al pagina 1
        $this->dispatch('post-created', 'post creado satisfactoriamente');
    }


    public function edit($postId)
    {
        // reglas especificas en este caso el edit


        $this->resetValidation();
        $this->postEdit->edit($postId);
        // $this->postEditId=$postId;
        // $this->open=true;

        // $post=Post::find($postId);

        // $this->postEdit['category_id']=$post->category_id;
        // $this->postEdit['title']=$post->title;
        // $this->postEdit['content']=$post->content;

        // $this->postEdit['selectedTags']=$post->tags->pluck('id')->toArray();

    }

    public function update()
    {
        //  $this->validate([

        // ]);
        // $post= Post::find($this->postEditId);
        // $post->update([
        //     'category_id' =>$this->postEdit['category_id'],
        //     'title' =>$this->postEdit['title'],
        //     'content' =>$this->postEdit['content'],
        // ]);

        // $post->tags()->sync($this->selectedTags);
        // $this->reset(['postEdit','postEditId','open']);
        $this->postEdit->update();
        // $this->post = Post::all();
        $this->dispatch('post-update', 'post actualizado');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        // $this->post = Post::all();
    }

    public function placeholder()
    {
        // return <<<'HTML'
        // <div>
        //     <p>Cargando ......</p>
        // </div>

        // HTML;

        return view('placeholder.skeletor');
    }

    #[Url(as: 's')]
    public $search ='';
    public function render()
    {

        $posts = Post::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->paginate(4, ['*'], 'pagePost');
        return view('livewire.formulario', compact('posts'));
    }
}
