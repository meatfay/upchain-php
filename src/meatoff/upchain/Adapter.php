<?php namespace meatoff\upchain;
/**
 * Created by PhpStorm.
 * User: meatoff
 * Date: 17.05.17
 * Time: 22:24
 */

/**
 * Interface Adapter for your own data transfer protocols
 * @package meatoff\upchain
 */

interface Adapter {
    public function __construct(Service $service, array $options);
    public function usePlugin($req, $res);
    public function action($req);
    public function serve();
}