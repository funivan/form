<?php

  namespace Fiv\Form\Validator;

  use Fiv\Form\Validator\Base;

  /**
   * Check if value not empty
   * Algorithm based on value length
   *
   * @package Fiv\Form\Validator
   */
  class Required extends Base {

    protected $error = 'Field is required ';

    /**
     * @param $error
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