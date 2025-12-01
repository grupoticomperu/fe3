<div>
    <p>Hola</p>
   {{--  {{ $localproductatributes }} --}}

    @foreach($localproductatributes as $localproductatribute)
        <p>{{ $localproductatribute->productatribute_id }} - {{ $localproductatribute->local_id }}</p>
    @endforeach
</div>
