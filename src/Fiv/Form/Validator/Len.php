<?php

  namespace Fiv\Form\Validator;

  use Fiv\Form\Validator\Base;

  /**
   * Check value length
   *
   * @author  Ivan Shcherbak <dev@funivan.com>
   * @package Fiv\Form\Validator
   */
  class Len extends \Fiv\Form\Validator\Base {

    protected $exactLen;

    protected $exactLenError;

    protected $maxLen = null;

    protected $maxLenError;

    protected $minLenError;

    protected $minLen;

    /**
     * Maximum len of value
     *
     * @param $len
     * @param $error
     * @return $this
     */
    public function max($len, $error) {
      $this->maxLen = $len;
      $this->maxLenError = $error;
      return $this;
    }

    /**
     * Minimum len of value
     *
     * @param $len
     * @param $error
     * @return $this
     */
    public function min($len, $error) {
      $this->minLen = $len;
      $this->minLenError = $error;
      return $this;
    }

    /**
     * Expect exact len of value
     *
     * @param $len
     * @param $error
     * @return $this
     */
    public function exact($len, $error) {
      $this->exactLen = $len;
      $this->exactLenError = $error;
      return $this;
    }

    /**
     * Validate value
     * @param string $value
     * @return bool
     */
    public function isValid($value) {

      if ($this->exactLen !== null and mb_strlen($value, 'UTF-8') != $this->exactLen) {
        $this->addError(vsprintf($this->exactLenError, [$this->exactLen]));
      }

      if ($this->maxLen !== null and mb_strlen($value, 'UTF-8') > $this->maxLen) {
        $this->addError(vsprintf($this->maxLenError, [$this->maxLen]));
      }

      if ($this->minLen !== null and mb_strlen($value, 'UTF-8') < $this->minLen) {
        $this->addError(vsprintf($this->minLenError, [$this->minLen]));
      }

      return !$this->hasErrors();
    }

  }