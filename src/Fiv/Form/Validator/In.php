<?php

  namespace Fiv\Form\Validator;


  /**
   * @author  Ivan Shcherbak <dev@funivan.com>
   * @package Fiv\Form\Validator
   */
  class In extends Base {

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

      if (!in_array($value, $this->values)) {
        $this->addError($this->error);
      }

      return !$this->hasErrors();
    }

  }