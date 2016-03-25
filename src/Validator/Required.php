<?php

  namespace Fiv\Form\Validator;

  /**
   * Check if value not empty
   * Algorithm based on value length
   *
   * @package Fiv\Form\Validator
   */
  class Required extends BaseValidator {

    /**
     * @var string
     */
    protected $error = 'Field is required';


    /**
     * @param string $error
     * @return $this
     */
    public function setError($error) {
      $this->error = $error;
      return $this;
    }


    /**
     * @param string $value
     * @return bool
     */
    public function isValid($value) {

      if (!empty($value)) {
        return true;
      }

      if (is_string($value) and $value !== '') {
        return true;
      }

      $this->addError($this->error);
      return false;
    }

  }