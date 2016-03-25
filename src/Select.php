<?php

  namespace Fiv\Form;

  use Fiv\Form\Element\Multiple;

  /**
   * Class TextArea
   * Generate <select></select> html tag
   *
   * @author  Ivan Shcherbak <dev@funivan.com>
   * @package Fiv\Form
   */
  class Select extends Multiple {

    /**
     * @return string
     */
    public function render() {
      $html = '<select ' . $this->getAttributesAsString() . ' >';
      $currentValue = $this->getValue();

      foreach ($this->options as $value => $text) {
        $html .= '<option'
          . ($currentValue == $value ? ' selected="1" ' : '')
          . ' value="' . $value . '"'
          . '>'
          . $text
          . '</option>';
      }
      $html .= '</select>';
      return $html;
    }
  }