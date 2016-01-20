<?php

  namespace Fiv\Form;

  use Fiv\Form\Element\BaseElement;

  /**
   * Class TextArea
   * Generate <textarea></textarea> html tag
   *
   * @author  Ivan Shcherbak <dev@funivan.com>
   * @package Fiv\Form
   */
  class TextArea extends BaseElement {

    /**
     * @return string
     */
    public function render() {
      return '<textarea ' . $this->getAttributesAsString() . '>' . $this->getValue() . '</textarea>';
    }

  }