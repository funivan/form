<?php

  /**
   * @author Ivan Shcherbak <dev@funivan.com>
   */
  namespace Fiv\Form\Filter;

  /**
   *
   * @package Fiv\Form\Filter
   */
  class RegexReplace implements FilterInterface {

    /**
     * @var null
     */
    protected $from = null;

    /**
     * @var string
     */
    protected $to = '';


    /**
     * @param string $from
     * @param string $to
     * @return \Fiv\Form\Filter\RegexReplace
     */
    public function __construct($from, $to = '') {
      $this->from = $from;
      $this->to = $to;
      return $this;
    }


    /**
     * @inheritdoc
     */
    public function apply($value) {
      return preg_replace($this->from, $this->to, $value);
    }

  }