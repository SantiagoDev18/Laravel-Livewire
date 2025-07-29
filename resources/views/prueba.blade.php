<x-app-layout>
    

 <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Prueba
        </h2>
    </x-slot>

     @persist('player')
    <audio src="{{asset('audio/audio.mp3')}}" controls></audio>
    @endpersist
    {{-- // si nosotros empezamos a navegar, si me dirijo entre paginas, si en ambas tienen persist con el mismo valor , no va tratar de sobreescribir va apersistir a lo largo, esto tambien sirve si queremos usar un buscador en paginas  --}}

    <script>
        // console.log('hola desde prueba');
        
    </script>

</x-app-layout>