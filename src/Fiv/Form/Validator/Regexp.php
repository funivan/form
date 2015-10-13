<?php

  namespace Fiv\Form\Validator;

  /**
   * @author Ivan Shcherbak <dev@funivan.com> 7/11/14
   */
  class Regexp extends Base {

    protected $error = 'Invalid value';

    protected $regexp = '';


    /**
     * @param string $regexp
     * @return $this
     */
    public function setRegexp($regexp) {
      $this->regexp = $regexp;
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
      if (!empty($this->regexp) and !preg_match($this->regexp, $value)) {
        $this->addError($this->error);
      }

      return !$this->hasErrors();
    }

  }