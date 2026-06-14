<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Aquafin - Dashboard</title>

    @php
    $isMobile = preg_match('/Android|iPhone|iPad/i', request()->userAgent());
    @endphp
    @if($isMobile)
    @vite(['resources/css/mobile.css'])
    @else
    @vite(['resources/css/style.css'])
    @endif
</head>
<body>

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

</body>
</html>