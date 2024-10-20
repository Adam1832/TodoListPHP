<?php

require_once __DIR__ . '/vendor/autoload.php';

use Core\Router;
use Controllers\TaskController;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader(__DIR__ . '/src/Views');
$twig = new Environment($loader);

$taskController = new TaskController();

$router = new Router();
$router->addRoute('/', [$taskController, 'index']);
$router->addRoute('/add', [$taskController, 'add']);
$router->addRoute('/store', [$taskController, 'store']);
$router->addRoute('/complete/{id}', function ($id) use ($taskController) {
    $taskController->complete($id);
});
$router->addRoute('/delete/{id}', function ($id) use ($taskController) {
    $taskController->delete($id);
});
$router->dispatch($_SERVER['REQUEST_URI']);

