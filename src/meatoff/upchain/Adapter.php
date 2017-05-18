<?php
/**
 * Created by PhpStorm.
 * User: meatoff
 * Date: 17.05.17
 * Time: 22:24
 */

namespace meatoff\upchain;


interface Adapter {
    public function __construct(Service $service, array $options);
    public function usePlugin($req, $res);
    public function action($req);
    public function serve();
}