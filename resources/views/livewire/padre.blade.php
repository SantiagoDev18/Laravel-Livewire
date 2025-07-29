<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    @persist('player')
    <audio src="{{asset('audio/audio.mp3')}}" controls></audio>
    @endpersist

    <x-button wire:click="redirigir">
        ir a Prueba
    </x-button>
    <h1 class="text-2x1">

        componenten padre
    </h1>

    <x-input wire:model.live="saludo"></x-input>
    <hr class="my-6">
    {{-- <h2>{{$hola}}</h2> --}}
    <livewire:hijo saludando="{{ $saludo }}" />

    <script>
        // console.log('hola desde componente padre');
        let a =0;
        //me ejecuta el codigo que defina cada cierto tiempo
        setInterval(() => {
            a++;
            console.log(a);
            
        }, );
        
    </script>

</div>
