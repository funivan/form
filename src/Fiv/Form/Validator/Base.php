<?php

  /**
   * @author Ivan Shcherbak <dev@funivan.com>
   */
  namespace Fiv\Form\Validator;

  /**
   *
   * @package Fiv\Form\Validator
   */
  abstract class Base {

    /**
     * @deprecated  use new keyword instead
     * 
     * @return $this
     */
    public static function i() {
      trigger_error('Deprecated', E_USER_DEPRECATED);
      return new static();
    }


    /**
     * @var array
     */
    protected $errors = [];


    /**
     * @param string $message
     * @return $this
     */
    public function addError($message) {
      $this->errors[] = $message;
      return $this;
    }


    /**
     * @return bool
     */
    public function hasErrors() {
      return !empty($this->errors);
    }


    /**
     * @return array
     */
    public function getErrors() {
      return $this->errors;
    }


    /**
     * @return $this
     */
    public function flushErrors() {
      $this->errors = [];
      return $this;
    }


    /**
     * @return null|string
     */
    public function getFirstError() {
      return !empty($this->errors[0]) ? $this->errors[0] : null;
    }


    /**
     * @param string $value
     */
    public abstract function isValid($value);

  }