<?php

  namespace Fiv\Form\Filter;

  /**
   * @deprecated use FilterInterface instead
   */
  abstract class Base implements FilterInterface {


    /**
     * @return static
     */
    public static function i() {
      trigger_error('Deprecated', E_USER_DEPRECATED);
      return new static();
    }

  }