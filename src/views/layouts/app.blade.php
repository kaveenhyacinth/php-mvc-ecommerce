<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>@yield('title', 'Sneaker Hub')</title>
</head>

<body>

<header class="app-header">
    <div class="header">
        <h1 class="header__text">Sneaker Hub</h1>
        <nav class="header__nav">
            <ul class="nav__list">
                <li class="nav__list__item"><a href="/">Home</a></li>
                <li class="nav__list__item"><a href="/products">Products</a></li>
                <li class="nav__list__item"><a href="/products/create">Create Product</a></li>
            </ul>
        </nav>
    </div>
</header>

<main class="app-content">
    @yield('content')
</main>

<footer class="app-footer"></footer>

</body>

</html>
