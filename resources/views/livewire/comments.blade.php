<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    {{-- //se muestra solo si estan articulos  --}}
    @if (count($comments))
        <div class="bg-white shadow round-lg p-6">
        <ul>
            @foreach ($comments as $comme )
            <li>{{$comme}}</li>
                
            @endforeach
        </ul>

        </div>
    @endif
      
</div>
