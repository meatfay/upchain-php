Upchain-php is modern protocol for communication with microservices through cluster.

##Install
```console
$ composer require meatoff/upchain
```

##Create Service
```php
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
```
##Create Cluster
For cluster creation you can use [upchain-js](https://github.com/matroskin13/upchain).