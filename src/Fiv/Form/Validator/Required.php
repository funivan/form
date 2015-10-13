<?php

  namespace Fiv\Form\Validator;
  
  /**
   * Check if value not empty
   * Algorithm based on value length
   *
   * @package Fiv\Form\Validator
   */
  class Required extends Base {

    /**
     * @var string
     */
    protected $error = 'Field is required ';


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

      if ((is_string($value) and strlen($value) === 0) or empty($value)) {
        $this->addError($this->error);
      }

      return !$this->hasErrors();
    }

  }