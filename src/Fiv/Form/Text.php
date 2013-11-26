<?php

  /**
   * @author Ivan Shcherbak <dev@funivan.com>
   */
  namespace Fiv\Form;

  /**
   * Generate <input type="text" /> html tag
   *
   * @package Fiv\Form
   */
  class Text extends Element\InlineInput {

    /**
     * @return string
     */
    protected function getType() {
      return 'text';
    }

  }