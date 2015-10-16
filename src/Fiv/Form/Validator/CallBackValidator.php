<?php

  namespace Fiv\Form\Validator;

  /**
   *
   * @package Fiv\Form\Validator
   */
  class CallBackValidator extends Base {

    /**
     * @var callable
     */
    protected $callback;

    /**
     * @var
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
      $result = call_user_func($this->callback, $value);
      if (!$result) {
        $this->addError($this->errorMessage);
      }
      return $result;
    }
  }