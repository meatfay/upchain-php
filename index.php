<?php
/**
 * Created by PhpStorm.
 * User: meatoff
 * Date: 24.04.17
 * Time: 22:15
 */
ini_set('display_errors', 1);
require_once 'vendor/autoload.php';

use meatoff\upchain\HttpAdapter;
use meatoff\upchain\Service;

$service = new Service(HttpAdapter::class);

$service->input("auth", function ($input, $payload) {
    if($input['email'] == 'meatfay@gmail.com' && $input['password'] == 'password') {
        $payload['token'] = md5("hello,world");
        $payload['user_id'] = 54;
    }
    return $payload;
});

$service->serve();