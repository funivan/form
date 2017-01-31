<?php

  declare(strict_types=1);

  namespace Tests\Fiv\Form\Element\Hidden;

  use Fiv\Form\Element\Hidden;
  use Fiv\Form\Form;
  use Fiv\Form\FormData;

  class HiddenValidatorTestCase extends \PHPUnit_Framework_TestCase {

    public function testCustomValidation() {
      $form = new Form();
      $form->setName('t');
      $element = new Hidden('test', '123');
      $element->addValidator(new SameValueValidator('123'));
      $form->addElement($element);

      $form->handle(new FormData('POST', ['t' => 1, 'test' => 123]));
      $validate = $form->isValid();
      self::assertTrue($validate);
      self::assertSame([], $element->validate()->getErrors());

      $form->handle(new FormData('POST', ['t' => 1, 'test' => '321']));
      $validate = $form->isValid();
      self::assertFalse($validate);
      self::assertSame(['Invalid field: test'], $form->getErrors());
      self::assertSame(['Invalid field: test'], $element->validate()->getErrors());
    }

  }
