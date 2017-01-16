<?php


  namespace Tests\Fiv\Form\Element;


  use Fiv\Form\Element\Input;
  use Fiv\Form\FormData;

  class InputTest extends \PHPUnit_Framework_TestCase {


    public function testElementRendering() {
      $input = new Input();
      $input->setType('text');
      $input->setValue('value');
      self::assertContains('<input type="text" value="value" ', $input->render());
    }


    public function testHandleRequest() {
      $input = new Input();
      $input->setName('email');

      $input->handle(new FormData(FormData::METHOD_POST, ['email' => 'test@test.com']));
      self::assertEquals('test@test.com', $input->getValue());
      $input->handle(new FormData(FormData::METHOD_POST, []));
      self::assertNull($input->getValue());
    }
  }