<?php

  declare(strict_types=1);

  namespace Fiv\Form\Validator;

  class ValidationResult implements ValidationResultInterface {

    /**
     * @var string[]
     */
    private $errors = [];


    public function merge(ValidationResult $validationResult) : self {
      foreach ($validationResult->getErrors() as $error) {
        $this->addError($error);
      }
      return $this;
    }


    public function addError(string $error) : self {
      $this->errors[] = $error;
      return $this;
    }


    public function getErrors() {
      return $this->errors;
    }


    public function isValid() : bool {
      return empty($this->errors);
    }

  }