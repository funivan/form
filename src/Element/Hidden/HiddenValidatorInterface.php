<?php

  declare(strict_types=1);

  namespace Fiv\Form\Element\Hidden;

  use Fiv\Form\Element\Hidden;
  use Fiv\Form\Validator\ValidationResultInterface;

  interface HiddenValidatorInterface {

    public function validate(Hidden $element) : ValidationResultInterface;

  }