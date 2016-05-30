<?php

  namespace Fiv\Form\Element;

  use Fiv\Form\FormData;

  /**
   *
   */
  interface ElementInterface {

    /**
     * @param FormData $request
     * @return $this
     */
    public function handle(FormData $request);


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