<?php

  namespace Fiv\Form\Element;

  /**
   * @method $this setName($name);
   *
   * @author  Ivan Shcherbak <dev@funivan.com>
   * @package Fiv\Form\Html
   */
  abstract class InlineInput extends Base {

    protected $tag = 'input';

    /**
     * Type of input
     *
     * @return string
     */
    protected abstract function getType();

    /**
     * @param $value
     * @return $this
     */
    public function setValue($value) {
      parent::setValue($value);
      $this->setAttribute('value', $this->value);
      return $this;
    }

    /**
     *
     * @return string
     */
    public function render() {
      $this->setType($this->getType());
      return parent::render();
    }

  }