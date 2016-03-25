<?php

  namespace Fiv\Form\Element;

  /**
   *
   */
  interface ElementInterface {

    /**
     * @param mixed $value
     * @return $this
     */
    public function setValue($value);


    /**
     * @return boolean
     */
    public function isValid();


    /**
     * @return string
     */
    public function getName();


    /**
     * @return string
     */
    public function getText();


    /**
     * @return string
     */
    public function render();

  }