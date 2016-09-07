<?php


  namespace Tests\Fiv\Form\Element;


  use Fiv\Form\Form;
  use Fiv\Form\FormData;

  class SubmitTest extends \PHPUnit_Framework_TestCase {


    public function testIsSubmitted() {
      $form = new Form();
      $loginElement = $form->submit('login', 'label login');
      $resendElement = $form->submit('resend', 'label resend');

      $form->handle(new FormData('post', [
        $form->getUid() => 1,
        'login' => null,
        'resend' => 'label resend',
      ]));

      static::assertFalse($loginElement->isSubmitted());
      static::assertTrue($resendElement->isSubmitted());
    }


    public function testGetValue() {
      $form = new Form();
      $submitElement = $form->submit('submit', 'label');

      $form->handle(new FormData('post', [
        $form->getUid() => 1,
        'submit' => '',
      ]));

      static::assertEquals('label', $submitElement->getValue());
    }
  }