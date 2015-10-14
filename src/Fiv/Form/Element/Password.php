<?php

  namespace Fiv\Form\Element;

  /**
   * @author Ivan Shcherbak <dev@funivan.com> 7/11/14
   */
  class Password extends Input {

    protected $type = 'password';


    public function render() {
      $this->attributes['value'] = null;
      return parent::render();
    }

  } 