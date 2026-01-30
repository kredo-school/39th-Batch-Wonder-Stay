<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    {{-- Admin Header --}}
    <nav class="navbar navbar-dark bg-dark px-3">
        <span class="navbar-brand">Admin Panel</span>
    </nav>

    <main class="container mt-4">
        @yield('content')
    </main>

</body>
</html>
