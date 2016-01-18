<?php

  namespace Fiv\Form\Element;

  /**
   * @author Ivan Shcherbak <dev@funivan.com> 7/11/14
   */
  class Input extends Base {

    /**
     * @var string
     */
    protected $tag = 'input';

    /**
     * @var string
     */
    protected $type = 'text';


    /**
     * @return string
     */
    public function getType() {
      if (empty($this->attributes['type'])) {
        $this->attributes['type'] = $this->type;
      }

      return $this->attributes['type'];
    }


    /**
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