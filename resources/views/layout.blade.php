<!DOCTYPE html>
<html lang="en">
@section('title', 'Начало')
<head>
    @include('partials.header')
</head>

<body class="mb-48">

    @include('partials.navbar')
    <link rel="stylesheet" href="{{ asset('css/background.css') }}">
    @yield('content')

    @include('partials.footer')
</body>
</html>


