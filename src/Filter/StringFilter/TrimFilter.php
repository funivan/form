<?php

  declare(strict_types=1);

  namespace Fiv\Form\Filter\StringFilter;

  class TrimFilter implements StringFilterInterface {

    public function apply(string $input) : string {
      return trim($input);
    }

  }