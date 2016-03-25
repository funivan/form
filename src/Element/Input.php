<?php

  namespace Fiv\Form\Element;

  /**
   * @author Ivan Shcherbak <dev@funivan.com> 7/11/14
   */
  class Input extends BaseElement {

    /**
     * @var string
     */
    protected $tag = 'input';

    /**
     * @var array
     */
    protected $attributes = [
      'type' => 'text',
    ];


    /**
     * @return null|string
     */
    public function getType() {
      return $this->getAttribute('type');
    }


    /**
     * Alias of $this->setAttribute('type' 'text');
     *
     * @param string $type
     * @return $this
     */
    public function setType($type) {
      $this->setAttribute('type', strtolower($type));
      return $this;
    }


    /**
     * @param $value
     * @return $this
     */
    public function setValue($value) {
      $this->setAttribute('value', $value);
      return $this;
    }


  }