<?php

  namespace Tests\Fiv\Form\Validator;

  use Fiv\Form\Form;
  use Fiv\Form\FormData;

  /**
   *
   */
  class RegexpTest extends \PHPUnit_Framework_TestCase {

    public function testRegexp() {
      $regexpValidator = new \Fiv\Form\Validator\Regexp();
      $regexpValidator->setRegexp('![^\@]+\@[^\@]+!');

      $form = new Form();
      $form->input('email')
        ->addValidator($regexpValidator);

      $form->handle(new FormData('post', [
        $form->getUid() => 1,
        'email' => 'test@test',
      ]));

      $this->assertTrue($form->isValid());

      $form->handle(new FormData('post', [
        $form->getUid() => 1,
        'email' => 'test',
      ]));

      $this->assertFalse($form->isValid());
    }
  }
