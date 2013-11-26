<?php

  /**
   * @author Ivan Shcherbak <dev@funivan.com>
   */
  namespace Fiv\Form\Validator;

  abstract class Base {

    /**
     * @return $this
     */
    public static function i() {
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

    protected function hasErrors() {
      return !empty($this->errors);
    }

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
     * @param string $value
     */
    public abstract function isValid($value);

  }