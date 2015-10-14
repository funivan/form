<?php

  namespace FormTests\Form;

  use Fiv\Form\Form;

  /**
   * @package FormTests\Form
   */
  class ValidatorsTest extends \FormTests\Main {

    public function testLen() {
      $lengthValidator = \Fiv\Form\Validator\Len::i();
      $lengthValidator->min(5, 'Мінімальна довжина логіну - 5 символів.');
      $lengthValidator->max(25, 'Максимальна довжина логіну - 25 символів.');

      $form = new Form();
      $form->input('login')
        ->addValidator($lengthValidator);

      $form->setData([
        $form->getUid() => 1,
        'login' => 'testLogin'
      ]);

      $this->assertTrue($form->isValid());

      $form->setData([
        $form->getUid() => 1,
        'login' => 'tes'
      ]);

      $this->assertFalse($form->isValid());

      $form->setData([
        $form->getUid() => 1,
        'login' => 'testtesttesttesttesttesttesttest'
      ]);

      $this->assertFalse($form->isValid());
    }


    public function testRequire() {
      $form = new Form();
      $form->input('login')
        ->addValidator(\Fiv\Form\Validator\Required::i());

      $form->setData([
        $form->getUid() => 1,
        'login' => 'testLogin'
      ]);

      $this->assertTrue($form->isValid());

      $form->setData([
        $form->getUid() => 1,
        'login' => ''
      ]);

      $this->assertFalse($form->isValid());
    }

    public function testRegexp() {
      $regexpValidator = \Fiv\Form\Validator\Regexp::i();
      $regexpValidator->setRegexp('![^\@]+\@[^\@]+!');
      
      $form = new Form();
      $form->input('email')
        ->addValidator($regexpValidator);

      $form->setData([
        $form->getUid() => 1,
        'email' => 'test@test'
      ]);

      $this->assertTrue($form->isValid());

      $form->setData([
        $form->getUid() => 1,
        'email' => 'test'
      ]);

      $this->assertFalse($form->isValid());
    }

    public function testIn() {
      $inValidator = \Fiv\Form\Validator\In::i();
      $inValidator->setValues(['a', 'b', 'c']);

      $form = new Form();
      $form->input('inputName')
        ->addValidator($inValidator);

      $form->setData([
        $form->getUid() => 1,
        'inputName' => 'a'
      ]);
      $this->assertTrue($form->isValid());

      $form->setData([
        $form->getUid() => 1,
        'inputName' => 'd'
      ]);
      $this->assertFalse($form->isValid());
    }
  }