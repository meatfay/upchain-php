<?php
/**
 * Created by PhpStorm.
 * User: meatoff
 * Date: 24.04.17
 * Time: 22:15
 */
require_once '../vendor/autoload.php';

use meatoff\upchain\HttpAdapter;
use meatoff\upchain\Service;

$service = new Service(HttpAdapter::class);

$service->input("auth", function ($input, $payload) {
    if($input['email'] == 'email@email.com' && $input['password'] == 'password') {
        $payload['auth_token'] = bin2hex(random_bytes(16));
        $payload['user_id'] = 534;
    }
    return $payload;
});

$service->serve();