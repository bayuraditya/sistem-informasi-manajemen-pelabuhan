<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <script src="{{ asset('html5-qrcode.min.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @stack('prepend-styles')
    @include('includes.styles')
    @stack('addon-styles')
    @yield('style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 
</head>

<body>
    <div id="app">
        @include('includes.sidebar')
        <div id="main">
            @yield('content')

            @include('includes.footer')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
    @stack('prepend-scripts')
    @include('includes.scripts')
    @stack('addon-script')
</body>

</html>
