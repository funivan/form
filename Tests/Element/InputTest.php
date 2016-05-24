<?php


  namespace Tests\Fiv\Form\Element;


  use Fiv\Form\Element\Input;
  use Fiv\Form\RequestContext;

  class InputTest extends \PHPUnit_Framework_TestCase {


    public function testElementRendering() {
      $input = new Input();
      $input->setType('text');
      $input->setValue('value');
      $this->assertContains('<input type="text" value="value" ', $input->render());
    }


    public function testHandleRequest() {
      $input = new Input();
      $input->setName('email');

      $input->handleRequestContext(new RequestContext(RequestContext::METHOD_POST, ['email' => 'test@test.com']));
      $this->assertEquals('test@test.com', $input->getValue());
      $input->handleRequestContext(new RequestContext(RequestContext::METHOD_POST, []));
      $this->assertNull($input->getValue());
    }
  }