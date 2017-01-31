<?php

  declare(strict_types=1);

  namespace Fiv\Form\Validation\StringValidation;

  use Fiv\Form\Elements\StringDataElementInterface;
  use Fiv\Form\Validation\ValidationResultInterface;

  class CallableStringValidator implements StringValidatorInterface {

    /**
     * @var callable
     */
    private $callable;


    public function __construct(callable $callable) {
      $this->callable = $callable;
    }


    public function validate(StringDataElementInterface $element) : ValidationResultInterface {
      $validator = $this->callable;
      return $validator($element);
    }

  }