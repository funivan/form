<?php

  namespace Fiv\Form\Element;

  use Fiv\Form\FormData;


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
  class CheckboxList extends Multiple {

    /**
     * @inheritdoc
     */
    public function handle(FormData $data) {
      $values = $data->get($this->getName());
      if ($values === null) {
        $values = [];
      } else {
        $values = (array) $values;
      }

      $this->setValue($values);
    }


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
     * @return array
     */
    public function getValue() {
      return (array) parent::getValue();
    }


    /**
     * @param string $optionKey
     * @return bool
     */
    public function isChecked($optionKey) {
      return in_array($optionKey, $this->getValue());
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