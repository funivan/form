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
      if (!empty($this->attributes['type'])) {
        return $this->attributes['type'];
      }

      return null;
    }


    /**
     * Alias of $this->setAttribute('type' 'text');
     * 
     * @param string $type
     * @return $this
     */
    public function setType($type) {
      $this->attributes['type'] = $type;
      return $this;
    }


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
      $this->setAttribute('type', $this->getType());
      return parent::render();
    }

  }