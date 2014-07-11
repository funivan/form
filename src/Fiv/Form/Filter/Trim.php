<?php

  namespace Fiv\Form\Filter;

  /**
   * @author  Ivan Shcherbak <dev@funivan.com>
   * @package Fiv\Form\Filter
   */
  class Trim extends \Fiv\Form\Filter\Base {

    /**
     * @param string $value
     * @return string
     */
    public function apply($value) {
      return trim($value);
    }

  }