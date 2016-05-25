<?php

  namespace Tests\Fiv\Form\Validator;

  use Fiv\Form\Form;
  use Fiv\Form\RequestContext;

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

      $form->handleRequestContext(new RequestContext('post', [
        $form->getUid() => 1,
        'email' => 'test@test',
      ]));

      $this->assertTrue($form->isValid());

      $form->handleRequestContext(new RequestContext('post', [
        $form->getUid() => 1,
        'email' => 'test',
      ]));

      $this->assertFalse($form->isValid());
    }
  }
