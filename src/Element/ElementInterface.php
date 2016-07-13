<?php

  namespace Fiv\Form\Element;

  use Fiv\Form\Filter\FilterInterface;
  use Fiv\Form\FormData;
  use Fiv\Form\Validator\ValidatorInterface;

  /**
   * @author Ivan Shcherbak <dev@funivan.com>
   */
  interface ElementInterface {

    /**
     * @param FormData $request
     * @return $this
     */
    public function handle(FormData $request);


    /**
     * @return boolean
     */
    public function isValid();


    /**
     * Attach validator to current element
     *
     * @param ValidatorInterface $validator
     * @return $this
     */
    public function addValidator(ValidatorInterface $validator);


    /**
     * @return ValidatorInterface[]
     */
    public function getValidators();


    /**
     * @return string[]
     */
    public function getValidatorsErrors();


    /**
     * Attach filter to current element
     *
     * @param FilterInterface $filter
     * @return $this
     */
    public function addFilter(FilterInterface $filter);


    /**
     * @return FilterInterface[]
     */
    public function getFilters();


    /**
     * @return mixed
     */
    public function getValue();


    /**
     * @param mixed $value
     * @return $this
     */
    public function setValue($value);


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