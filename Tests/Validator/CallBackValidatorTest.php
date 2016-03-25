<?php

  namespace Tests\Fiv\Form\Validator;

  use Fiv\Form\Form;
  use Fiv\Form\Validator\CallBackValidator;

  /**
   *
   */
  class CallBackValidatorTest extends \PHPUnit_Framework_TestCase {

    public function testLen() {
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


    public function testEmailVirtualDbValidation() {
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
