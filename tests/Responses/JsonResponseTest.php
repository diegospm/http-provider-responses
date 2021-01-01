<?php

declare(strict_types=1);

namespace HttpProvider\Tests\Responses;

use \HttpProvider\Interfaces\ResponseInterface;
use \HttpProvider\Responses\JsonResponse;
use \PHPUnit\Framework\TestCase;

class JsonResponseTest extends TestCase
{
    private JsonResponse $response;

    private const CODE = 200;

    private const CONTENT = 'HTTP/1.1 200' . "\r\n\r\n" . 'Foo Bar';

    private const DATA = array('foo' => 'bar');

    protected function setUp(): void
    {
        parent::setUp();

        $this->response = new JsonResponse();
    }

    public function testSetContent(): void
    {
        $this->assertInstanceOf(ResponseInterface::class, $this->response->setContent(self::CONTENT));
    }

    public function testGetContent(): void
    {
        $this->response->setContent(self::CONTENT);
        $this->assertEquals(self::CONTENT, $this->response->getContent());
    }

    public function testSetStatusCode(): void
    {
        $this->assertInstanceOf(ResponseInterface::class, $this->response->setStatusCode(self::CODE));
    }

    public function testGetStatusCode(): void
    {
        $this->response->setStatusCode(self::CODE);
        $this->assertEquals(self::CODE, $this->response->getStatusCode());
    }

    public function testToArray(): void
    {
        $this->response->setContent(self::CONTENT);
        $this->assertEquals(null, $this->response->toArray());

        $this->response->setContent(json_encode(self::DATA));
        $this->assertEquals(self::DATA, $this->response->toArray());
    }

    public function testToObject(): void
    {
        $this->response->setContent(self::CONTENT);
        $this->assertEquals(null, $this->response->toObject());

        $object = new \stdClass;
        $object->foo = 'bar';

        $this->response->setContent(json_encode(self::DATA));
        $this->assertEquals($object, $this->response->toObject());
    }
}
