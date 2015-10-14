<?php

  /**
   * @author Ivan Shcherbak <dev@funivan.com>
   */
  namespace Fiv\Form\Filter;

  /**
   *
   * @package Fiv\Form\Filter
   */
  class RegexReplace extends \Fiv\Form\Filter\Base {

    protected $from = null;

    protected $to = '';


    /**
     * @param        $from
     * @param string $to
     * @return \Fiv\Form\Filter\RegexReplace
     */
    public function __construct($from, $to = '') {
      $this->from = $from;
      $this->to = $to;
      return $this;
    }


    /**
     * @param sting $value
     * @return mixed|string
     */
    public function apply($value) {
      return preg_replace($this->from, $this->to, $value);
    }

  }