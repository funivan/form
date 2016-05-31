<?php

  namespace Fiv\Form\Validator;

  /**
   *
   * @package Fiv\Form\Validator
   */
  class CallBackValidator extends BaseValidator {

    /**
     * @var callable
     */
    protected $callback;

    /**
     * @var string|null
     */
    protected $errorMessage;


    /**
     * @param callable $callback
     */
    public function __construct(callable $callback) {
      $this->callback = $callback;
    }


    /**
     * @param string $errorMessage
     * @return $this
     */
    public function setErrorMessage($errorMessage) {
      $this->errorMessage = $errorMessage;
      return $this;
    }


    /**
     * @param string $value
     * @return mixed
     */
    public function isValid($value) {
      $this->errors = [];
      
      $result = call_user_func($this->callback, $value);
      if ($result) {
        return true;
      }

      $this->addError($this->errorMessage);
      return false;
    }
  }