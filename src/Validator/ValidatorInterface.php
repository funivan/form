<?php
  namespace Fiv\Form\Validator;


  /**
   *
   * @package Fiv\Form\Validator
   */
  interface ValidatorInterface {

    /**
     * Should clear own errors before each validation
     * @param array|string $value
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