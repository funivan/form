<?php

  namespace Fiv\Form\Validator;

  /**
   * @author Ivan Shcherbak <dev@funivan.com> 7/11/14
   */
  class Regexp extends BaseValidator {

    /**
     * @var string
     */
    protected $error = 'Invalid value';

    /**
     * @var string|null
     */
    protected $regexp = null;


    /**
     * @param string $regexp
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setRegexp($regexp) {
      if (!is_string($regexp)) {
        throw new \InvalidArgumentException('Invalid regexp type. Expect string');
      }
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
     * @todo check if we can pass array
     *
     * @param string $value
     * @return bool
     */
    public function isValid($value) {
      if ($this->regexp === null) {
        return true;
      }

      if (preg_match($this->regexp, $value)) {
        return true;
      }

      $this->addError($this->error);
      return false;
    }

  }