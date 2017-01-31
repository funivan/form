<?php

  declare(strict_types=1);

  namespace Tests\Fiv\Form\Element\Hidden;

  use Fiv\Form\Element\Hidden;
  use Fiv\Form\Validator\ValidationResult;

  class CallableHiddenValidatorTest extends \PHPUnit_Framework_TestCase {

    public function testCustomCallableValidator() {
      $validator = new Hidden\CallableHiddenValidator(function (Hidden $element) {
        $result = new ValidationResult();
        if ($element->getValue() !== '123') {
          $result->addError('Error: ' . $element->getName());
        }
        return $result;
      });

      $element = new Hidden('test', '123');
      $element->addValidator($validator);

      self::assertSame([], $element->validate()->getErrors());

      $secondHidden = new Hidden('other', '123');
      $secondHidden->addValidator($validator);
      self::assertSame([], $secondHidden->validate()->getErrors());

      $element->setValue('321');
      self::assertSame(['Error: test'], $element->validate()->getErrors());

      $secondHidden->setValue('Other value');
      self::assertSame(['Error: other'], $secondHidden->validate()->getErrors());
    }

    public function testValidationCallNum() {
      $validationIterationsNum = 0;
      $validator = new Hidden\CallableHiddenValidator(function () use(&$validationIterationsNum) {
        $validationIterationsNum++;
        return new ValidationResult();
      });

      $element = new Hidden('test', '123');
      $element->addValidator($validator);
      self::assertSame(0, $validationIterationsNum);
      $element->validate();
      self::assertSame(1, $validationIterationsNum);

      $element->validate();
      $element->validate();
      self::assertSame(3, $validationIterationsNum);

    }

  }
