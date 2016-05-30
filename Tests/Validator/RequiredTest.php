<?php

  namespace Tests\Fiv\Form\Validator;

  use Fiv\Form\Form;
  use Fiv\Form\FormData;
  use Fiv\Form\Validator\Required;
  use PHPUnit_Framework_TestCase;

  /**
   *
   */
  class RequiredTest extends PHPUnit_Framework_TestCase {


    public function testSimpleValidation() {
      $validator = new Required();
      $validator->setError('Test error message');

      $form = new Form();
      $form->input('login')
        ->addValidator($validator);

      $form->handle(new FormData('post', [
        $form->getUid() => 1,
        'login' => 'testLogin',
      ]));

      $this->assertTrue($form->isValid());
      $this->assertEmpty($validator->getErrors());

      $form->handle(new FormData('post', [
        $form->getUid() => 1,
        'login' => '',
      ]));

      $this->assertFalse($form->isValid());
      $this->assertEquals('Test error message', $validator->getFirstError());

      $form->handle(new FormData('post', [
        $form->getUid() => 1,
        'login' => '0',
      ]));
      $this->assertTrue($form->isValid());
    }

  }
