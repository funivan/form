<?php


  namespace Tests\Fiv\Form\Element;


  use Fiv\Form\Element\BaseElement;
  use Fiv\Form\RequestContext;

  class BaseElementTest extends \PHPUnit_Framework_TestCase {


    public function testGetSetValue() {
      $element = new BaseElement();
      $this->assertNull($element->getValue());
      $element->setValue('test value');

      $this->assertEquals('test value', $element->getValue());
      $this->assertEquals('test value', $element->getAttribute('value'));

      $element->clearValue();
      $this->assertNull($element->getValue());
      $this->assertNull($element->getAttribute('name'));
    }


    public function testDefaultIsValidResult() {
      $element = new BaseElement();
      $this->assertTrue($element->isValid());
    }

    public function testHandleRequest(){
      $element = new BaseElement();
      $element->setName('email');
      $element->setAttribute('type', 'email');
      $element->handleRequestContext(new RequestContext('post', ['email' => 'test@test.com']));

      $this->assertEquals('test@test.com', $element->getValue());
      $this->assertEquals('test@test.com', $element->getAttribute('value'));

      $element->handleRequestContext(new RequestContext('post', ['email' => 'test2@test.com']));

      $this->assertEquals('test2@test.com', $element->getValue());
      $this->assertEquals('test2@test.com', $element->getAttribute('value'));
    }
  }