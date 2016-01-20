<?php
  namespace Fiv\Form\Validator;


  /**
   *
   * @package Fiv\Form\Validator
   */
  interface ValidatorInterface {

    /**
     * @return array
     */
    public function getErrors();


    /**
     * @param array|string $value
     */
    public function isValid($value);

  }