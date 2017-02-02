<?php

  declare(strict_types=1);

  namespace Fiv\Form\Filter\StringFilter;

  interface StringFilterInterface {

    public function apply(string $input) : string;

  }