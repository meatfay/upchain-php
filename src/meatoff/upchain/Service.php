<?php namespace meatoff\upchain;
/**
 * Created by PhpStorm.
 * User: meatoff
 * Date: 03.05.17
 * Time: 18:51
 */

use Closure;

/**
 * Service class.
 * @package meatoff\upchain
 */
class Service
{
    private $adapter;
    private $options;
    private $events = [];

    /**
     * Service constructor.
     * @param string $adapter
     * @param array $options
     */
    public function __construct(string $adapter, array $options = []) {
        $this->adapter = new $adapter($this, $options);
        $this->options = $options;
    }

    /**
     * Listening all events what had been added.
     * @param array $input
     * @param array $payload
     * @return array
     */
    public function listener(array $input, array $payload) : array {
        $lists = array_map(function($event) use ($input, $payload) {
            $inputProperty = isset($input[$event['property']]) ?? null;
            $payloadProperty = $payload[$event['property']] ?? null;

            if($inputProperty || $payloadProperty) {
                return $this->useEvent($event['callback'], $input, $payload);
            } else {
                return [];
            }
        }, $this->events);

        return $lists;
    }

    /**
     * Execute callback from argument and return result
     * @param Closure $callback
     * @param array $input
     * @param array $payload
     * @return array
     */
    public function useEvent(Closure $callback, array $input, array $payload) : array {
        $result = $callback($input, $payload);

        if(!$result) {
            return [];
        }
        return $result;
    }

    /**
     * Runs events
     */
    public function serve() {
        $this->adapter->serve();
    }

    /**
     * Add a new events
     * @param string $type
     * @param string $property
     * @param Closure $callback
     */
    public function addEvent(string $type, string $property, Closure $callback) {
        array_push($this->events, [
            'type' => $type,
            'property' => $property,
            'callback' => $callback
        ]);
    }

    /**
     * Add a new input event
     * @param string $property
     * @param Closure $callback
     */
    public function input(string $property, Closure $callback) {
        $this->addEvent("input", $property, $callback);
    }

    /**
     * Add a new payload event
     * @param string $property
     * @param Closure $callback
     */
    public function payload(string $property, Closure $callback) {
        $this->addEvent("payload", $property, $callback);
    }
}