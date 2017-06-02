<?php
/**
 * Created by PhpStorm.
 * User: meatoff
 * Date: 20.05.17
 * Time: 9:07
 */

namespace tests\Tests;


use meatoff\upchain\Adapter;
use meatoff\upchain\Service;

class MockHttpAdapter implements Adapter {

    public function __construct(Service $service, array $options)
    {
    }

    public function usePlugin($req, $res)
    {
        // TODO: Implement usePlugin() method.
    }

    public function action($req)
    {
        // TODO: Implement action() method.
    }

    public function serve()
    {
        // TODO: Implement serve() method.
    }
}