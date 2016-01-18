<?php

  namespace Fiv\Form\Filter;

  /**
   * @author  Ivan Shcherbak <dev@funivan.com>
   * @package Fiv\Form\Filter
   */
  class Trim implements FilterInterface{

    /**
     * @inheritdoc
     */
    public function apply($value) {
      return trim($value);
    }

  }