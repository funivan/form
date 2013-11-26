<?php

  namespace Fiv\Form\Validator;

  use Fiv\Form\Validator\Base;

  /**
   * @author  Ivan Shcherbak <dev@funivan.com>
   * @package Fiv\Form\Validator
   */
  class In extends Base {

    protected $error = 'Invalid value';

    protected $values = [];

    /**
     * @param array $values
     * @return $this
     */
    public function setValues($values) {
      $this->values = $values;
      return $this;
    }


    protected function setError($error) {
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