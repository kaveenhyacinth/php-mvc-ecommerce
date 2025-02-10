<?php

    namespace App\Helpers;

    use Jenssegers\Blade\Blade;

    function view(string $template, array $data = [], string $layout = 'mainLayout'): void
    {
        extract($data);

        $views = __DIR__ . "/../../views";
        $cache = __DIR__ . "/../../cache";
        $blade = new Blade($views, $cache . '/views');
        echo $blade->render($template, $data);
    }
