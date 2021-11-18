<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<meta content="" name="keywords">
<link href="{{ asset('img/favicon/co-globe.png') }}" rel="icon">
<link href="{{ asset('img/favicon/co-globe.png') }}" rel="apple-touch-icon">
<title>
    @isset($prefixTitle)
        {{ $prefixTitle . ' - ' }}
    @endisset
    @yield('title')
</title>
