<?php

  /**
   * @author Ivan Shcherbak <dev@funivan.com>
   */
  namespace Fiv\Form\Element;

  /**
   * Generate <input type="submit" /> element
   *
   * @author Ivan Shcherbak <dev@funivan.com>
   */
  class Submit extends \Fiv\Form\Element\Input {

    /**
     * @var array
     */
    protected $attributes = [
      'type' => 'submit',
    ];


  }