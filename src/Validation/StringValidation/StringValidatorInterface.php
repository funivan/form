<?php

  declare(strict_types=1);

  namespace Fiv\Form\Validation\StringValidation;

  use Fiv\Form\Elements\StringDataElementInterface;
  use Fiv\Form\Validation\ValidationResultInterface;

  interface StringValidatorInterface {

    public function validate(StringDataElementInterface $element) : ValidationResultInterface;

  }