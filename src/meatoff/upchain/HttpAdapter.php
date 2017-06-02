<?php namespace meatoff\upchain;

/**
 * Class HttpAdapter - example of Adapter implementation.
 * @package meatoff\upchain
 * @since PHP 7.0.1
 */
class HttpAdapter implements Adapter
{

    private $service;
    private $params;

    /**
     * HttpAdapter constructor.
     * @param Service $service
     * @param array $options
     */
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
        return $req;
    }

    public function response(array $result) {
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * Run listening to take payloads from events.
     */
    public function serve(){
        $this->response($this->action($this->params));
    }
}