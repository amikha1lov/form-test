<?php
use App\Controllers\FeedbackController;
use Dotenv\Dotenv;
use MiladRahimi\PhpRouter\Exceptions\InvalidCallableException;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use MiladRahimi\PhpRouter\Router;
use MiladRahimi\PhpRouter\View\View;

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = Router::create();
$router->setupView(__DIR__ . '/views');

$router->get('/', function (View $view) {
    return $view->make('feedback', []);
});


$router->post('/add', [FeedbackController::class, 'add']);

try {
    $router->dispatch();
} catch (InvalidCallableException|RouteNotFoundException $e) {
    var_dump($e);
}