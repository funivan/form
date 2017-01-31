<?php

  declare(strict_types=1);

  namespace Tests\Fiv\Form\Element\Hidden;

  use Fiv\Form\Elements\StringDataElementInterface;
  use Fiv\Form\Validation\StringValidation\StringValidatorInterface;
  use Fiv\Form\Validation\ValidationResult;
  use Fiv\Form\Validation\ValidationResultInterface;

  class SameValueValidator implements StringValidatorInterface {

    /**
     * @var string
     */
    private $expectValue;


    public function __construct(string $expectValue) {
      $this->expectValue = $expectValue;
    }


    public function validate(StringDataElementInterface $element) : ValidationResultInterface {
      $validationResult = new ValidationResult();

      if ($this->expectValue === $element->getValue()) {
        return $validationResult;
      }

      $validationResult->addError('Invalid field: ' . get_class($element));

      return $validationResult;
    }
  }