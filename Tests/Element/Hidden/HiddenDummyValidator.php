<?php

  declare(strict_types=1);

  namespace Tests\Fiv\Form\Element\Hidden;

  use Fiv\Form\Element\Hidden;
  use Fiv\Form\Element\Hidden\HiddenValidatorInterface;
  use Fiv\Form\Validator\ValidationResult;
  use Fiv\Form\Validator\ValidationResultInterface;

  class HiddenDummyValidator implements HiddenValidatorInterface {

    /**
     * @var string
     */
    private $expectValue;


    public function __construct(string $expectValue) {
      $this->expectValue = $expectValue;
    }


    public function validate(Hidden $element) : ValidationResultInterface {
      $validationResult = new ValidationResult();

      if ($this->expectValue !== $element->getValue()) {
        $validationResult->addError('Invalid field: ' . $element->getName());
      }

      return $validationResult;
    }
  }