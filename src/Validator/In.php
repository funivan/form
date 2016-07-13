<?php

  namespace Fiv\Form\Validator;


  /**
   * @author Ivan Shcherbak <dev@funivan.com>
   */
  class In extends BaseValidator {

    /**
     * @var string
     */
    protected $error = 'Invalid value';

    /**
     * @var array
     */
    protected $values = [];


    /**
     * @param array $values
     * @return $this
     */
    public function setValues($values) {
      $this->values = $values;
      return $this;
    }


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
      $this->errors = [];

      if (in_array($value, $this->values)) {
        return true;
      }

      $this->addError($this->error);
      return false;
    }

  }