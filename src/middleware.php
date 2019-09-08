<?php

use Slim\App;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;

$logger = new Logger("slim");
$rotating = new RotatingFileHandler(__DIR__ . "/logs/slim.log", 0, Logger::DEBUG);
$logger->pushHandler($rotating);

return function (App $app) use($logger) {
    // e.g: $app->add(new \Slim\Csrf\Guard);

    $app->add(new \Tuupola\Middleware\JwtAuthentication([
        "path" => ["/users", "/admin","/courses"],
        "attribute" => "decoded_token_data",
        "secret" => PASSKEY,
        "logger" => $logger,
        "algorithm" => ["HS256"],
       
        "error" => function ($response, $arguments) {
            $data["status"] = "error";
            $data["message"] = $arguments["message"];
            return $response
                ->withHeader("Content-Type", "application/json")
                ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        },
    ]));
};
