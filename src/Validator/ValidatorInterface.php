<?php
  namespace Fiv\Form\Validator;


  /**
   *
   * @package Fiv\Form\Validator
   */
  interface ValidatorInterface {

    /**
     * Must clear own errors before each validation
     * @param array|string $value
     * @return bool
     */
    public function isValid($value);


    /**
     * @return array
     */
    public function getErrors();


    /**
     * @return bool
     */
    public function hasErrors();


    /**
     * @param string $message
     * @return $this
     */
    public function addError($message);

  }