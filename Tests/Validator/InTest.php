<?php

  namespace Tests\Fiv\Form\Validator;

  use Fiv\Form\Form;
  use Fiv\Form\FormData;

  /**
   *
   */
  class InTest extends \PHPUnit_Framework_TestCase {


    public function testIn() {
      $inValidator = new \Fiv\Form\Validator\In();
      $inValidator->setValues(['a', 'b', 'c']);

      $form = new Form();
      $form->input('inputName')
        ->addValidator($inValidator);

      $form->handle(new FormData('post', [
        $form->getUid() => 1,
        'inputName' => 'a',
      ]));
      self::assertTrue($form->isValid());

      $form->handle(new FormData('post', [
        $form->getUid() => 1,
        'inputName' => 'd',
      ]));
      self::assertFalse($form->isValid());
    }

  }
