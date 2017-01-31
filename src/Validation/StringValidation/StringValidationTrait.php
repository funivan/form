<?php

  declare(strict_types=1);

  namespace Fiv\Form\Validation\StringValidation;

  use Fiv\Form\Validation\ValidationResult;
  use Fiv\Form\Validation\ValidationResultInterface;

  trait StringValidationTrait {

    /**
     * @var StringValidatorInterface[]
     */
    private $validators = [];


    public function addValidator(StringValidatorInterface $validator) : self {
      $this->validators[] = $validator;
      return $this;
    }



    public function validate() : ValidationResultInterface {

      $validationResult = new ValidationResult();
      foreach ($this->validators as $validator) {
        $result = $validator->validate($this);
        $validationResult->merge($result);
      }

      return $validationResult;
    }
  }