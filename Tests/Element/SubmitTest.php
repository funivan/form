<?php


  namespace Tests\Fiv\Form\Element;


  use Fiv\Form\Form;
  use Fiv\Form\FormData;

  class SubmitTest extends \PHPUnit_Framework_TestCase {


    public function testIsSubmitted() {
      $form = new Form();
      $submitElement = $form->submit('submit', 'label');

      $form->handle(new FormData('post', [
        $form->getUid() => 1,
        'submit' => 'label',
      ]));

      static::assertTrue($submitElement->isSubmitted());

      $form->handle(new FormData('post', [
        $form->getUid() => 1,
        'submit' => '',
      ]));

      static::assertFalse($submitElement->isSubmitted());
    }
  }