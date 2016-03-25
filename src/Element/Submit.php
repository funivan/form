<?php

  /**
   * @author Ivan Shcherbak <dev@funivan.com>
   */
  namespace Fiv\Form\Element;

  /**
   * Class Submit
   * Generate <input type="submit" /> element
   *
   * @package Fiv\Form
   */
  class Submit extends \Fiv\Form\Element\Input {

    /**
     * @var array
     */
    protected $attributes = [
      'type' => 'submit',
    ];


  }