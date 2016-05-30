<?php

  namespace Fiv\Form\Element;

  use Fiv\Form\FormData;

  /**
   *
   * @author  Ivan Shcherbak <dev@funivan.com>
   * @package Fiv\Form\Html
   */
  class Multiple extends BaseElement {

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
     * @inheritdoc
     */
    public function handle(FormData $data) {
      $this->setValue($data->get($this->getName()));
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