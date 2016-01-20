<?php

  namespace Fiv\Form\Element;

  /**
   * @author Ivan Shcherbak <dev@funivan.com> 7/11/14
   */
  class Password extends Input {

    /**
     * @var array
     */
    protected $attributes = [
      'type' => 'password',
    ];


    /**
     * @return string
     */
    public function render() {
      $this->attributes['value'] = null;
      return parent::render();
    }

  } 