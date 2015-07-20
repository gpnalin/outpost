<?php

namespace Outpost\Web\Requests;

use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream\Stream;

class RequestTest extends \PHPUnit_Framework_TestCase {

  public function testGetRequestUrl() {
    $url = "http://example.com/";
    $request = new Request($url);
    $this->assertEquals($url, $request->getRequestUrl());
  }

  public function testGetRequestMethod() {
    $method = 'POST';
    $request = new Request(null, $method);
    $this->assertEquals($method, $request->getRequestMethod());
  }

  public function testProcessRequest() {
    $body = 'this is the response body';
    $request = new Request(null);
    $response = new Response(200, [], Stream::factory($body));
    $this->assertEquals($body, $request->processResponse($response));
  }

  public function testValidateRequest() {
    $body = 'this is the response body';
    $request = new Request(null);
    $response = new Response(200, [], Stream::factory($body));
    $request->validateResponse($response);
  }

  /**
   * @expectedException \Outpost\Web\Exceptions\UnauthorizedException
   */
  public function testUnauthorizedRequest() {
    $body = 'this is the response body';
    $request = new Request(null);
    $response = new Response(401, [], Stream::factory($body));
    $request->validateResponse($response);
  }

  /**
   * @expectedException \Outpost\Web\Exceptions\NotFoundException
   */
  public function testResponseNotFound() {
    $body = 'this is the response body';
    $request = new Request(null);
    $response = new Response(404, [], Stream::factory($body));
    $request->validateResponse($response);
  }

  /**
   * @expectedException \Outpost\Web\Exceptions\ClientErrorException
   */
  public function testOtherClientError() {
    $body = 'this is the response body';
    $request = new Request(null);
    $response = new Response(405, [], Stream::factory($body));
    $request->validateResponse($response);
  }

  /**
   * @expectedException \Outpost\Web\Exceptions\InternalServerErrorException
   */
  public function testInternalServerError() {
    $body = 'this is the response body';
    $request = new Request(null);
    $response = new Response(500, [], Stream::factory($body));
    $request->validateResponse($response);
  }

  /**
   * @expectedException \Outpost\Web\Exceptions\NotImplementedException
   */
  public function testNotImplemented() {
    $body = 'this is the response body';
    $request = new Request(null);
    $response = new Response(501, [], Stream::factory($body));
    $request->validateResponse($response);
  }

  /**
   * @expectedException \Outpost\Web\Exceptions\ServerErrorException
   */
  public function testOtherServerError() {
    $body = 'this is the response body';
    $request = new Request(null);
    $response = new Response(502, [], Stream::factory($body));
    $request->validateResponse($response);
  }
}