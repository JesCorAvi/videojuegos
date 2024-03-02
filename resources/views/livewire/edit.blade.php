<div>
        <select name="distribuidora_id" id="">
            @foreach ($distribuidoras as $distribuidora)
                @if(!($videojuego->desarrolladora->distribuidora->id === $desarrolladora->distribuidora->id))
                    <option value="{{$distribuidora->id}}">{{$distribuidora->nombre}}</option>
                @endif
            @endforeach
        </select>
</div>
