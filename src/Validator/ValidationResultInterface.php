<?php

  declare(strict_types=1);

  namespace Fiv\Form\Validator;

  interface ValidationResultInterface {

    /**
     * @return string[]
     */
    public function getErrors();


    public function isValid() : bool;

  }