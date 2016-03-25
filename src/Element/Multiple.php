<?php

  namespace Fiv\Form\Element;

  /**
   *
   * @author  Ivan Shcherbak <dev@funivan.com>
   * @package Fiv\Form\Html
   */
  class Multiple extends \Fiv\Form\Element\BaseElement {

    /**
     * @var array
     */
    protected $options = [];


    /**
     * @param array $values
     * @return $this
     */
    public function setOptions($values) {
      $this->options = $values;
      return $this;
    }


    /**
     * @return array
     */
    public function getOptions() {
      return $this->options;
    }


    /**
     * @param string $value
     * @return $this
     */
    public function setValue($value) {
      if (!isset($this->options[$value])) {
        reset($this->options);
        $value = key($this->options);
      }

      return parent::setValue($value);
    }

  }