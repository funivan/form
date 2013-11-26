<?php

  /**
   * @author Ivan Shcherbak <dev@funivan.com>
   */
  namespace Fiv\Form;

  /**
   * Class Submit
   * Generate <input type="submit" /> element
   *
   * @package Fiv\Form
   */
  class Checkbox extends Element\InlineInput {

    protected $value = 1;

    protected $label = '';

    /**
     * Value in checkbox can be true or false
     *
     * @param int|boolean $value
     * @return $this
     */
    public function setValue($value) {
      $value = !empty($value) ? 1 : 0;
      if ($value) {
        $this->check();
      }
      return parent::setValue($value);
    }

    /**
     * @return $this
     */
    public function check() {
      $this->setAttribute('checked', 'checked');
      return $this;
    }

    /**
     * @return $this
     */
    public function unCheck() {
      $this->removeAttribute('checked');
      return $this;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setLabel($text) {
      $this->label = $text;
      return $this;
    }

    /**
     * @return string
     */
    public function render() {
      return '<label>' . parent::render() . $this->label . '</label>';
    }

    /**
     * @return string
     */
    protected function getType() {
      return 'checkbox';
    }

  }