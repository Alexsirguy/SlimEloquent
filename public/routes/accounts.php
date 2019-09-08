<?php
use Firebase\JWT\JWT;
use Moonsat\Clique\Models\general;
use Moonsat\Clique\Models\workplaces;

$app->group('/accounts', function () use ($app, $container) {

    $app->post('/validates/', function ($request, $response, array $args) use ($container) {
        try {
                        }
        } catch (Exception $ex) { 

       }
        echo json_encode($status);
    }); 
    $app->post('/create/', function ($request, $response, array $args) use ($container) {
        $status = array();
        try {
                } catch (Exception $e) {request";
        }
        echo json_encode($status);
    });

    $app->post('/login', function ($request, $response, array $args) use ($container) {
        $status = array();
        try {
                    } catch (Exception $ex) {
        }
        echo json_encode($status);
    });

});
