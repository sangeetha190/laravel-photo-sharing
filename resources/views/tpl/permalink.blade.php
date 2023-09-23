@extends('front_end')
@section('content')
    <table style="width:100%">
        <tr>
            <td width='450' valign="top">
                <p>Title: {{ $image->title }}</p>
                <img src="{{ url(Config::get('image.uploads_folder') . '/' . $image->image) }}" alt="" width="800"
                    height="500">
            </td>
            <td>
                <p>Direct Image URL</p>
                <input type="text" onclick="this.select()" width="100%"
                    value="{{ url(Config::get('image.uploads_folder') . '/' . $image->image) }}">
                <p>Thumbnail HTML code</p>
                <input type="text" onclick="this.select()" width="100%"
                    value="<a href='{{ url('snatch/' . $image->id) }}'> <img src='{{ url(Config::get('image.uploads_folder') . '/' . $image->image) }}'/></a>">
            </td>
        </tr>
        <tr>
            <td>
                <a href="{{ url('delete/' . $image->id) }}">Delete Image</a>
            </td>
            <td>
                <a href="{{ url('all') }}">See All Images</a>
            </td>
        </tr>
    </table>
