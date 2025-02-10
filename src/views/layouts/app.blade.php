<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>@yield('title', 'Laravel Blade')</title>
</head>

<body>

<header class="app-header">
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/products">Products</a></li>
            <li><a href="/products/create">Create Product</a></li>
        </ul>
    </nav>
</header>

<main class="app-content">
    @yield('content')
</main>

<footer class="app-footer"></footer>

</body>

</html>
