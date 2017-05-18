<?php namespace meatoff\upchain;
/**
 * Created by PhpStorm.
 * User: meatoff
 * Date: 24.04.17
 * Time: 22:32
 */
class HttpAdapter implements Adapter
{
    private $service;
    private $params;

    public function __construct(Service $service, array $options = []) {
        $this->service = $service;

        $postdata = file_get_contents("php://input");
        $parse = json_decode($postdata, true);

        if(is_null($parse)) {
            echo 'parse error';
        } else {
            $this->params = $parse;
        }
    }

    public function usePlugin($req, $res) {

    }

    public function action($req) {
        $req['payload'] = $this->service->listener($req['input'], $req['payload']);
        header('Content-Type: application/json');
        echo json_encode($req);
    }

    public function serve(){
        $this->action($this->params);
    }
}