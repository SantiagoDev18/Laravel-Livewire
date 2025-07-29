<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="bg-white shadow round-lg p-6">

        @if ($postCreate->image)
            {
            <img src="{{ $postCreate->image->temporaryUrl() }}" alt="">
            }
        @endif

        <form action="" wire:submit="save">
            <div class="mb-4">
                <x-label>Nombre</x-label>

                <x-input class="w-full" wire:model.live="postCreate.title"></x-input>
                {{-- @error('title')
                    the required 
                @enderror --}}
<<<<<<< HEAD
                <!-- <x-input-error for="title"></x-input-error> -->
=======
                <x-input-error for="postCreate.title"></x-input-error>
>>>>>>> bca203b (refactorizacion)
            </div>
            <div class="mb-4">
                <x-label>Contenido</x-label>
                <x-textarea class="w-full" wire:model="postCreate.content">juanito alimaña</x-textarea>
                <x-input-error for="postCreate.content"></x-input-error>
            </div>
            <div class="mb-4">
                <x-label>
                    Categoria
                </x-label>
                <select name="" id="" class="w-full" wire:model.live="postCreate.category_id">

                    <option value="" disabled>
                        selecciona una categoriagit 
                    </option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <x-input-error for="postCreate.category_id"></x-input-error>

            </div>

            <div class="mb-4">
                <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">

                    <x-label>imagen</x-label>
                    <x-input type="file" wire:model="postCreate.image"></x-input>
                    <div x-text=progress></div>
                    <div x-show="isUploading">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <x-label>Etiqueta</x-label>
                <ul>
                    @foreach ($tags as $tag)
                        <li>
                            <label for="">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                    wire:model="postCreate.tags">
                                {{ $tag->name }}
                            </label>
                        </li>
                    @endforeach
                </ul>


            </div>
            <div class="flex justify-end">
                <x-button wire:loading.class="opacity-25">Crear</x-button>
            </div>
        </form>

        {{-- <div wire:loading wire:target="save">
            Procesando.......
        </div> --}}

        {{-- //por defecto livewire usa el display:inline --}}
        {{-- <div class="flex justify-between" wire:loading>
            <div>
                hola
            </div>
            <div>mundo</div>
        </div> --}}

    </div>
    <br>
    <div class="bg-white shadow round-lg p-6">

        <div class="mb-4">
            <x-input class="w-full"
            aria-placeholder="buscar"
            wire:model.live="search">

            </x-input>

        </div>

        <ul class="list-disc list-inside">

            @foreach ($posts as $post)
                {{-- //para un correcto seguimiento cuando hay un bucle colocamos el wire:key --}}
                <li class="flex justify-between" wire:key="post--{{ $post->id }}">
                    {{ $post->title }}
                    <x-button wire:click="edit({{ $post->id }})">Editar</x-button>
                    <x-danger-button wire:click="destroy({{ $post->id }})">Eliminar</x-danger-button>
                </li>
            @endforeach

        </ul>

        <div class="mt-4">
            {{ $posts->links() }}
        </div>

    </div>
    {{-- formulario de edicion  --}}

    {{-- /usamos el componente de jetstream  --}}

    {{-- @if ($open)


        <div class=" fixed inset-0">

            <div class="py-12">

                <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-black shadow round-lg p-6">
                        <form action="" wire:submit="update">
                            <div class="mb-4">
                                <x-label>Nombre</x-label>

                                <x-input class="w-full" wire:model="postEdit.title"></x-input>
                            </div>
                            <div class="mb-4">
                                <x-label>Contenido</x-label>
                                <x-textarea class="w-full" wire:model="postEdit.content">juanito alimaña</x-textarea>
                            </div>
                            <div class="mb-4">
                                <x-label>
                                    Categoria
                                </x-label>
                                <select name="" id="" class="w-full" wire:model="postEdit.category_id">
                                    <option value="" disabled>
                                        selecciona una categoria
                                    </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <x-label>Etiqueta</x-label>
                                <ul>
                                    @foreach ($tags as $tag)
                                        <li>
                                            <label for="">
                                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                                    wire:model="postEdit.selectedTags">
                                                {{ $tag->name }}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>


                            </div>
                            <div class="flex justify-end">
                                <x-danger-button wire:click="$set('open',false)">Cancelar</x-danger-button>

                                <x-button type="submit">Update</x-button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <!-- Fondo semitransparente del modal -->

    @endif --}}
    <form action="" wire:submit="update">
        <x-dialog-modal wire:model="postEdit.open">
            <x-slot name="title">
                Actualizar post

            </x-slot>
            <x-slot name="content">


                <div class="mb-4">
                    <x-label>Nombre</x-label>

                    <x-input class="w-full" wire:model="postEdit.title"></x-input>
                    <x-input-error for="postEdit.title"></x-input-error>
                </div>
                <div class="mb-4">
                    <x-label>Contenido</x-label>
                    <x-textarea class="w-full" wire:model="postEdit.content">juanito alimaña</x-textarea>
                </div>
                <div class="mb-4">
                    <x-label>
                        Categoria
                    </x-label>
                    <select name="" id="" class="w-full" wire:model="postEdit.category_id">
                        <option value="" disabled>
                            selecciona una categoria
                        </option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <x-label>Etiqueta</x-label>
                    <ul>
                        @foreach ($tags as $tag)
                            <li>
                                <label for="">
                                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                        wire:model="postEdit.tags">
                                    {{ $tag->name }}
                                </label>
                            </li>
                        @endforeach
                    </ul>


                </div>


            </x-slot>
            <x-slot name="footer">
                <div class="flex justify-end">
                    <x-danger-button wire:click="$set('postEdit.open',false)">Cancelar</x-danger-button>

                    <x-button>Update</x-button>
                </div>
            </x-slot>
        </x-dialog-modal>
    </form>



    @push('js')
        <script>
            Livewire.on('post-created', function(message) {
                console.log('Desde JS:', message);

            });
        </script>
    @endpush


</div>
