<?php

  namespace FormTests\Form;

  use Fiv\Form\Form;
  use Fiv\Form\Validator\CallBackValidator;

  /**
   * @package FormTests\Form
   */
  class ValidatorsTest extends \FormTests\Main {

    public function testLen() {
      $lengthValidator = new \Fiv\Form\Validator\Len();
      $lengthValidator->min(5, 'Мінімальна довжина логіну - 5 символів.');
      $lengthValidator->max(25, 'Максимальна довжина логіну - 25 символів.');

      $form = new Form();
      $form->input('login')
        ->addValidators([$lengthValidator]);

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
        ->addValidators([new \Fiv\Form\Validator\Required()]);

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
      $regexpValidator = new \Fiv\Form\Validator\Regexp();
      $regexpValidator->setRegexp('![^\@]+\@[^\@]+!');

      $form = new Form();
      $form->input('email')
        ->addValidators([$regexpValidator]);

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
      $inValidator = new \Fiv\Form\Validator\In();
      $inValidator->setValues(['a', 'b', 'c']);

      $form = new Form();
      $form->input('inputName')
        ->addValidators([$inValidator]);

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


    public function testCallBackValidatorEmail() {
      $form = new Form();

      $existEmailList = [
        'test1@gmail.com',
        'promo@yandex.ru',
      ];

      $callBackValidator = (new CallBackValidator(function ($value) use ($existEmailList) {
        if (empty($value)) {
          return true;
        }
        if (in_array($value, $existEmailList)) {
          return false;
        }
        return true;
      }))->setErrorMessage('Email already exist!');

      $input = $form->input('email');
      $input->addValidators([$callBackValidator]);
      
      $form->setData([
        $form->getUid() => 1,
        'email' => 'test1@gmail.com',
      ]);
      
      $this->assertFalse($form->isValid());
      $this->assertEquals('Email already exist!', $callBackValidator->getFirstError());

      $form->setData([
        $form->getUid() => 1,
        'email' => 'new-email@gmail.com',
      ]);

      $this->assertTrue($form->isValid());
    }
  }