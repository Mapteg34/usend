<?php

use App\Controller;

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../app/helpers.php';

// здесь должен быть роутинг
// и нормальная обработка ошибок
// и инициализация сервисов

try {
    $controller = new Controller();
    echo $controller->fetch();
} catch (\Exception $e) {
    echo 'Error: '.htmlspecialchars($e->getMessage());
}