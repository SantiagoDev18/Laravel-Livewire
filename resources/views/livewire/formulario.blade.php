<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="bg-white shadow round-lg p-6">
        <form action="" wire:submit="save">
            <div class="mb-4">
                <x-label>Nombre</x-label>

                <x-input class="w-full" wire:model="title"></x-input>
                {{-- @error('title')
                    the required 
                @enderror --}}
                <!-- <x-input-error for="title"></x-input-error> -->
            </div>
            <div class="mb-4">
                <x-label>Contenido</x-label>
                <x-textarea class="w-full" wire:model="content">juanito alimaña</x-textarea>
                <x-input-error for="content"></x-input-error>
            </div>
            <div class="mb-4">
                <x-label>
                    Categoria
                </x-label>
                <select name="" id="" class="w-full" wire:model="category_id">
                    
                    <option value="" disabled>
                        selecciona una categoriagit 
                    </option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <!-- <x-input-error for="category_id"></x-input-error> -->
            </div>
            <div class="mb-4">
                <x-label>Etiqueta</x-label>
                <ul>
                    @foreach ($tags as $tag)
                        <li>
                            <label for="">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                    wire:model="selectedTags">
                                {{ $tag->name }}
                            </label>
                        </li>
                    @endforeach
                </ul>


            </div>
            <div class="flex justify-end">
                <x-button>Crear</x-button>
            </div>
        </form>

    </div>
    <br>
    <div class="bg-white shadow round-lg p-6">

        <ul class="list-disc list-inside">

            @foreach ($post as $post)
                {{-- //para un correcto seguimiento cuando hay un bucle colocamos el wire:key --}}
                <li class="flex justify-between" wire:key="post--{{ $post->id }}">
                    {{ $post->title }}
                    <x-button wire:click="edit({{ $post->id }})">Editar</x-button>
                    <x-danger-button wire:click="destroy({{ $post->id }})">Eliminar</x-danger-button>
                </li>
            @endforeach

        </ul>

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
        <x-dialog-modal wire:model="open">
            <x-slot name="title">
                Actualizar post

            </x-slot>
            <x-slot name="content">


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


            </x-slot>
            <x-slot name="footer">
                <div class="flex justify-end">
                    <x-danger-button wire:click="$set('open',false)">Cancelar</x-danger-button>

                    <x-button>Update</x-button>
                </div>
            </x-slot>
        </x-dialog-modal>
    </form>
</div>
