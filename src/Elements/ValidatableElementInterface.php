<?php

  declare(strict_types=1);

  namespace Fiv\Form\Elements;

  use Fiv\Form\Validation\ValidationResultInterface;

  interface ValidatableElementInterface {

    public function validate() : ValidationResultInterface;

  }