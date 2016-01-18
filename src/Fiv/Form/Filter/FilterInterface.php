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
  interface FilterInterface {

    /**
     * Modify value and return it
     *
     * @param mixed $value
     * @return mixed
     */
    public function apply($value);

  }