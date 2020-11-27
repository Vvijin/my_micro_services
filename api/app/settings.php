<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Logger;

return function (ContainerBuilder $containerBuilder) {
    // Global Settings Object
    $containerBuilder->addDefinitions([
        'settings' => [
            'displayErrorDetails' => true, // Should be set to false in production
            'logger' => [
                'name' => 'slim-app',
                'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
                'level' => Logger::DEBUG,
            ],
            "db" => [
                'driver' => 'mysql',
                'host' => 'localhost:3306',
                'database' => 'animal',
                'username' => 'root',
                'password' => '',
                'collation' => 'utf8_general_ci',
                'charset' => 'utf8',
                'prefix' => ''
                ],
        ],
    ]);
};
