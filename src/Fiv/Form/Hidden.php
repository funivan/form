<?php

  namespace Fiv\Form;

  /**
   * Generate <input type="hidden" /> element
   *
   * @author  Ivan Shcherbak <dev@funivan.com>
   * @package Fiv\Form
   */
  class Hidden extends Element\InlineInput {

    /**
     * @return string
     */
    protected function getType() {
      return 'hidden';
    }

  }