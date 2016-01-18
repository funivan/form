<?php

  namespace Fiv\Form;

  use Fiv\Form\Element\Base;

  /**
   * Class TextArea
   * Generate <textarea></textarea> html tag
   *
   * @author  Ivan Shcherbak <dev@funivan.com>
   * @package Fiv\Form
   */
  class TextArea extends Base {

    /**
     * @return string
     */
    public function render() {
      return '<textarea ' . $this->getAttributesAsString() . '>' . $this->getValue() . '</textarea>';
    }

  }