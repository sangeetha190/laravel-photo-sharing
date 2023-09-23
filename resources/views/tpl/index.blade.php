@extends('front_end')
@section('content')
    <form action="/" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="title" placeholder="Please insert your url" />
        <input type="file" name="image" id="" />
        <input type="submit" value="Save" name="send" />
    </form>
    <a href="{{ url('all') }}">See All Images</a>
@stop
