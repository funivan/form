<?php

  namespace Fiv\Form\Filter;


  /**
   * Filters used to prepare input value
   *
   * If user add some whitespaces you can apply trim filter
   *
   * @author  Ivan Shcherbak <dev@funivan.com>
   * @package Fiv\Form
   */
  abstract class Base {

    /**
     * Modify value and return it
     *
     * @param mixed $value
     * @return string
     */
    public abstract function apply($value);


    /**
     * @return static
     */
    public static function i() {
      trigger_error('Deprecated', E_USER_DEPRECATED);
      return new static();
    }

  }