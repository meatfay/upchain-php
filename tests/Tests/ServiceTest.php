<?php namespace tests\Tests;

use meatoff\upchain\HttpAdapter;
use PHPUnit\Framework\TestCase;
use meatoff\upchain\Service;


class ServiceTest extends TestCase {

    public $service;

    public function setUp()
    {
        $this->service = new Service(MockHttpAdapter::class);
    }

    public function testSetListener() {
        $callback = function($input, $payload) {
            $this->assertInternalType('array', $payload);
            $this->assertInternalType('array', $input);
            $payload['name'] = 'Pavel';
            return $payload;
        };
        $this->assertEquals('Pavel', $callback([],[])['name']);
        $this->service->input('user', $callback);
    }


    /**
     * @depends testFirst
     */
    public function testSecond(bool $bl) {
        $this->assertFalse($bl);
    }
}
