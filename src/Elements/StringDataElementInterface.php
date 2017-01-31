<?php

  declare(strict_types=1);

  namespace Fiv\Form\Elements;

  /**
   * Used for the validations and Filters
   *
   * This interface is in draft. Can be renamed in any time.
   */
  interface StringDataElementInterface extends DataElementInterface {

    public function getValue() : string;

  }