@extends('front_end')
@section('content')

    @if (count($images) > 0)
        <ul>
            @foreach ($images as $image)
                <li><a href="{{ url('snatch/' . $image->id) }}"><img
                            src="{{ Config::get('image.thumb_folder') . '/' . $image->image }}" /></a></li>
            @endforeach
        </ul>
        <p>{{ $images->links() }}</p>
    @else
        <p>No images uploaded yet, <a href="{{ url('/') }}">Care to upload?</a></p>
    @endif
@stop
