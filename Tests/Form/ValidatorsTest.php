<?php

  namespace Tests\Form\Form;

  use Fiv\Form\Form;
  use Fiv\Form\Validator\CallBackValidator;

  /**
   * @package Tests\Form\Form
   */
  class ValidatorsTest extends \Tests\Form\MainTestCase {

    public function testCallback() {
      $lengthValidator = new CallBackValidator(function ($value) {
        return strlen($value) > 3 and strlen($value) < 10;
      });

      $form = new Form();
      $form->input('login')
        ->addValidator($lengthValidator);

      $form->setData([
        $form->getUid() => 1,
        'login' => 'testLogin',
      ]);

      $this->assertTrue($form->isValid());
      $this->assertFalse($lengthValidator->hasErrors());




      $form->setData([
        $form->getUid() => 1,
        'login' => 'tes',
      ]);

      $this->assertFalse($form->isValid());
      $this->assertTrue($lengthValidator->hasErrors());

      $form->setData([
        $form->getUid() => 1,
        'login' => 'testtesttesttesttesttesttesttest',
      ]);

      $this->assertFalse($form->isValid());
    }


    public function testRequire() {
      $form = new Form();
      $form->input('login')
        ->addValidator(new \Fiv\Form\Validator\Required());

      $form->setData([
        $form->getUid() => 1,
        'login' => 'testLogin',
      ]);

      $this->assertTrue($form->isValid());

      $form->setData([
        $form->getUid() => 1,
        'login' => '',
      ]);

      $this->assertFalse($form->isValid());
    }


    public function testRegexp() {
      $regexpValidator = new \Fiv\Form\Validator\Regexp();
      $regexpValidator->setRegexp('![^\@]+\@[^\@]+!');

      $form = new Form();
      $form->input('email')
        ->addValidator($regexpValidator);

      $form->setData([
        $form->getUid() => 1,
        'email' => 'test@test',
      ]);

      $this->assertTrue($form->isValid());

      $form->setData([
        $form->getUid() => 1,
        'email' => 'test',
      ]);

      $this->assertFalse($form->isValid());
    }


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
      $input->addValidator($callBackValidator);

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