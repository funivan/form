<?php

  namespace Fiv\Form;

  /**
   * Class TextArea
   * Generate
   * ```html
   * <input type="checkbox" name="languages[]" value="en">
   * <input type="checkbox" name="languages[]" value="ru">
   * ```
   * html tags
   *
   * @author  Ivan Shcherbak <dev@funivan.com>
   * @package Fiv\Form
   */
  class CheckboxList extends \Fiv\Form\Element\Multiple {

    /**
     * @param array|string $data
     * @return $this
     */
    public function setValue($data) {
      if (!is_array($data)) {
        $data = (array) $data;
      }

      foreach ($data as $i => $value) {
        # remove invalid values
        if (!isset($this->options[$value])) {
          unset($data[$i]);
        }
      }

      $this->value = array_values($data);
      return $this;
    }


    /**
     * Alias of setValue
     *
     * @param string[] $values
     * @return $this
     */
    public function setChecked($values) {
      return $this->setValue($values);
    }


    /**
     * @return string
     */
    public function render() {
      $html = '';
      $currentValues = $this->getValue();
      $attributes = $this->attributes;
      $attributes['type'] = 'checkbox';

      $name = $this->getName();

      foreach ($this->options as $value => $text) {
        $attributes['value'] = $value;
        $attributes['name'] = $name . '[]';
        if (in_array($value, $currentValues)) {
          $attributes['checked'] = 'checked';
        } else {
          unset($attributes['checked']);
        }

        $html .= '<label>' . static::tag('input', $attributes) . $text . '</label>';
      }

      return $html;
    }
  }