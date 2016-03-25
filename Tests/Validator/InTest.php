<?php

  namespace Tests\Fiv\Form\Validator;

  use Fiv\Form\Form;

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

      $form->setData([
        $form->getUid() => 1,
        'inputName' => 'a',
      ]);
      $this->assertTrue($form->isValid());

      $form->setData([
        $form->getUid() => 1,
        'inputName' => 'd',
      ]);
      $this->assertFalse($form->isValid());
    }

  }
