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

    /**
     * @var null
     */
    protected $from = null;

    /**
     * @var string
     */
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
     * @param string $value
     * @return mixed|string
     */
    public function apply($value) {
      return preg_replace($this->from, $this->to, $value);
    }

  }