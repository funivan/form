<?php

  namespace Fiv\Form;

  /**
   * Generate <input type="submit" /> element
   *
   * @author Ivan Shcherbak <dev@funivan.com>
   * @package Fiv\Form
   */
  class Checkbox extends Element\Input {

    protected $value = 1;

    protected $label = '';


    /**
     * Value in checkbox can be true or false
     *
     * @param int|boolean $value
     * @return $this
     */
    public function setValue($value) {
      if (!empty($value)) {
        return $this->check();
      } else {
        return $this->unCheck();
      }

    }


    /**
     * @return $this
     */
    public function check() {
      $this->setAttribute('checked', 'checked');
      parent::setValue(1);
      return $this;
    }


    /**
     * Set value to 0
     * @return $this
     */
    public function unCheck() {
      $this->removeAttribute('checked');
      parent::setValue(0);
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
      $this->setType('checkbox');
      return '<label>' . parent::render() . $this->label . '</label>';
    }

  }