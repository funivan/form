<?php

  namespace Fiv\Form\Element;

  /**
   * Generate <input type="radio"> html tag
   *
   * @author Ivan Shcherbak <dev@funivan.com>
   */
  class RadioList extends Multiple {

    /**
     * @return string
     */
    public function render() {
      $html = '';
      $currentValue = $this->getValue();
      $attributes = $this->attributes;
      $attributes['type'] = 'radio';

      foreach ($this->options as $value => $text) {
        $attributes['value'] = $value;
        if ($currentValue == $value) {
          $attributes['checked'] = 'checked';
        } else {
          unset($attributes['checked']);
        }

        $html .= '<label>' . static::tag('input', $attributes) . $text . '</label>';
      }

      return $html;
    }
  }