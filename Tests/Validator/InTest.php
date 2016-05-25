<?php

  namespace Tests\Fiv\Form\Validator;

  use Fiv\Form\Form;
  use Fiv\Form\RequestContext;

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

      $form->handleRequestContext(new RequestContext('post', [
        $form->getUid() => 1,
        'inputName' => 'a',
      ]));
      $this->assertTrue($form->isValid());

      $form->handleRequestContext(new RequestContext('post', [
        $form->getUid() => 1,
        'inputName' => 'd',
      ]));
      $this->assertFalse($form->isValid());
    }

  }
