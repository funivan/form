<?php

  namespace Fiv\Form\Filter;

  /**
   * @author  Ivan Shcherbak <dev@funivan.com>
   * @package Fiv\Form\Filter
   */
  class Trim implements FilterInterface{

    /**
     * @deprecated
     * @see CallbackFilter
     */
    public function __construct() {
      trigger_error('Deprecated', E_USER_DEPRECATED);
    }


    /**
     * @inheritdoc
     */
    public function apply($value) {
      return trim($value);
    }

  }