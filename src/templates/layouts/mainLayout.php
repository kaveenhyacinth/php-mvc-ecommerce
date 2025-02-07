<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Ecommerce</title>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/products">Products</a></li>
            <li><a href="/products/create">Create Product</a></li>
        </ul>
    </nav>
</header>
<main>
    <!-- This is where each page’s content is injected -->
    <?= $content; ?>
</main>
<footer></footer>
</body>
</html>
