<?php

    namespace App\Helpers;

    function view(string $template, array $data = [], string $layout = 'mainLayout'): void
    {
        extract($data);

        ob_start();
        require __DIR__ . "/../../templates/$template.php";
        $content = ob_get_clean();

        require __DIR__ . "/../../templates/layouts/$layout.php";
    }
