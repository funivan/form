<?php

  namespace Fiv\Form\Filter;

  use Fiv\Form\Text;

  /**
   * Class Form
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
     * @param $value Text value
     * @return string
     */
    public abstract function apply($value);

    /**
     * @return static
     */
    public static function i() {
      return new static();
    }

  }