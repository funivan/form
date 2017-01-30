<?php

  declare(strict_types=1);

  namespace Fiv\Form\Element\Hidden;

  use Fiv\Form\Element\Hidden;
  use Fiv\Form\Validator\ValidationResultInterface;

  class CallableHiddenValidator implements HiddenValidatorInterface {

    /**
     * @var callable
     */
    private $callable;


    public function __construct(callable $callable) {
      $this->callable = $callable;
    }

    public function validate(Hidden $element) : ValidationResultInterface {
      $validator = $this->callable;
      return $validator($element);
    }

  }