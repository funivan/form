<?php

  namespace Fiv\Form\Element;

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
      return '<textarea ' . Html::renderAttributes($this->getAttributes()) . '>' . $this->getValue() . '</textarea>';
    }

  }