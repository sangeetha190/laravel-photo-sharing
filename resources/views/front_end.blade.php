<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Front_End Page</title>
    {{-- style sheet link --}}
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
</head>

<body>
    <h2>Your awesome Image Sharing Website</h2>
    {{-- only one error will come so first() method is use --}}
    @if (Session::has('errors'))
        <div class="danger">{{ $errors->first() }}</div>
    @endif

    @if (Session::has('error'))
        <div class="danger">{{ Session::get('error') }}</div>
    @endif

    @if (Session::has('success'))
        <div class="success">{{ Session::get('success') }}</div>
    @endif

    @yield('content')
</body>

</html>
