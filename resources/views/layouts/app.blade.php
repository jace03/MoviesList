<!DOCTYPE html>
<html>
<head>
    <title>Movies App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
    <body class="bg-gray-900 text-white min-h-screen">
        <div class="min-h-screen flex flex-col">
            @yield('content')
            {{-- your existing app.js or other scripts --}}
            <script src="{{ asset('js/app.js') }}"></script>

        @stack('scripts')
    </body>
</html>
