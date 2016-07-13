<?php

  namespace Fiv\Form\Element;

  /**
   * Generate <select></select> html tag
   *
   * @author Ivan Shcherbak <dev@funivan.com>
   */
  class Select extends Multiple {

    /**
     * @return string
     */
    public function render() {
      $html = '<select ' . Html::renderAttributes($this->getAttributes()) . ' >';
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