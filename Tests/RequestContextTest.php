<?php


  namespace Tests\Fiv\Form;


  use Fiv\Form\RequestContext;

  class RequestContextTest extends \PHPUnit_Framework_TestCase {

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidHttpMethodValue() {
      new RequestContext('invalid', []);
    }


    public function testRequestContext() {
      $testData = [
        'name' => 'petro',
        'email' => 'petro@gmail.com',
      ];
      $requestContext = new RequestContext(RequestContext::METHOD_POST, $testData);

      $this->assertEquals(RequestContext::METHOD_POST, $requestContext->getMethod());
      $this->assertFalse($requestContext->isMethod(RequestContext::METHOD_GET));
      $this->assertTrue($requestContext->isMethod(RequestContext::METHOD_POST));

      $this->assertEquals(['name' => 'petro', 'email' => 'petro@gmail.com'], $requestContext->getData());

      $this->assertEquals('petro', $requestContext->get('name'));
      $this->assertNull($requestContext->get('age'));

      $this->assertTrue($requestContext->has('email'));
      $this->assertFalse($requestContext->has('age'));
    }
  }