<?php

  namespace Fiv\Form\Validator;

  /**
   *
   * @author Ivan Shcherbak <dev@funivan.com>
   */
  abstract class BaseValidator implements ValidatorInterface {

    /**
     * @var array
     */
    protected $errors = [];


    /**
     * @param string $value
     * @return bool
     */
    public abstract function isValid($value);


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
     * @return null|string
     */
    public function getFirstError() {
      return !empty($this->errors[0]) ? $this->errors[0] : null;
    }
  }