<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>@yield('title', 'Shoeman Hub')</title>
</head>

<body>

<header class="app-header">
    <div class="header">
        <h1 class="header__logo">
            <a href="/">Shoeman Hub</a>
        </h1>
        <div class="header__actions">
            <a class="actions__cart" href="/cart">
                <span class="cart__count">@yield('cartCount', 0)</span>
                <img alt="" src="assets/images/shopping-bag.svg" width="24" height="24"/>
            </a>
        </div>
    </div>
</header>

<main class="app-content">
    @yield('content')
</main>

<footer class="app-footer"></footer>

<script src="assets/js/main.js"></script>

</body>

</html>
