<?php
declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Application\Actions\Animal\ListAnimalsAction;
use App\Application\Actions\Animal\NewAnimalAction;
use App\Application\Actions\Animal\GetAnimalAction;
use App\Application\Actions\Animal\UpdateAnimalAction;
use App\Application\Actions\Animal\DeleteAnimalAction;

return function (App $app) {
    $app->options('/{routes:.*}', function (
        Request $request,
        Response $response
    ) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });

    $app->group('/animals', function (Group $group) {
        $group->get('', ListAnimalsAction::class);
        $group->get('/{id}', GetAnimalAction::class);
        $group->post('', NewAnimalAction::class);
        $group->put('/{id}', UpdateAnimalAction::class);
        $group->delete('/{id}', DeleteAnimalAction::class);
    });

    
};
