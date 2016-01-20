<?php

  namespace Fiv\Form\Element;

  use Fiv\Form\Filter\FilterInterface;
  use Fiv\Form\Validator;

  /**
   * @package Fiv\Form\Element
   * @author Ivan Shcherbak <dev@funivan.com> 2016
   * @method $this setName($name);
   * @method string getName();
   * @method $this setClass($class);
   * @method string getClass();
   * @method $this setId($id);
   * @method string getId();
   */
  class BaseElement extends \Fiv\Form\Element\Html {

    /**
     * @var null|boolean
     */
    protected $validationResult = null;

    /**
     * @var \Fiv\Form\Validator\Base[]
     */
    protected $validators = [];

    /**
     * @var \Fiv\Form\Filter\FilterInterface[]
     */
    protected $filters = [];

    /**
     * @var string
     */
    protected $text = '';

    /**
     * @var null|string
     */
    protected $value = null;


    /**
     * Attach validator to current element
     *
     * @param \Fiv\Form\Validator\ValidatorInterface[]|\Fiv\Form\Validator\ValidatorInterface $validator
     * @throws \Exception
     * @return $this
     */
    public function addValidator($validator) {
      if (!is_array($validator)) {
        $validator = [$validator];
      }
      $this->validationResult = null;
      foreach ($validator as $validatorClass) {
        if (!($validatorClass instanceof Validator\ValidatorInterface)) {
          throw new \Exception('Invalid validator class: ' . get_class($validatorClass));
        }
        $this->validators[] = $validatorClass;
      }

      return $this;
    }


    /**
     * @param string $text
     * @return $this
     */
    public function setText($text) {
      $this->text = $text;
      return $this;
    }


    /**
     * @return mixed
     */
    public function getText() {
      return $this->text;
    }


    /**
     * Attach filter to current element
     *
     * @param \Fiv\Form\Filter\FilterInterface|\Fiv\Form\Filter\FilterInterface[] $filter
     * @throws \Exception
     * @return $this
     */
    public function addFilter($filter) {
      if (!is_array($filter)) {
        $filter = [$filter];
      }
      foreach ($filter as $filterClass) {
        if (!($filterClass instanceof FilterInterface)) {
          throw new \Exception('Invalid filter class: ' . get_class($filterClass));
        }
        $this->filters[] = $filterClass;
      }

      return $this;
    }


    /**
     * Alias of setAttribute('value', $value)
     *
     * @param $value
     * @return $this
     */
    public function setValue($value) {
      $this->setAttribute('value', $value);
      return $this;
    }


    /**
     * @inheritdoc
     */
    public function setAttribute($name, $value) {
      if ($name === 'value') {

        $this->validationResult = null;

        # apply filters to the value
        $filters = $this->getFilters();
        foreach ($filters as $filter) {
          $value = $filter->apply($value);
        }

        $value = htmlentities($value, ENT_COMPAT);
        $this->value = $value;
      }

      return parent::setAttribute($name, $value);
    }


    /**
     * @return \Fiv\Form\Filter\FilterInterface[]
     */
    public function getFilters() {
      return $this->filters;
    }


    /**
     * Return true if element is valid
     * @return boolean
     */
    public function validate() {

      if ($this->validationResult !== null) {
        return $this->validationResult;
      }

      $this->validationResult = true;
      $value = $this->getValue();
      foreach ($this->getValidators() as $validator) {
        $validator->flushErrors();
        if (!$validator->isValid($value)) {
          $this->validationResult = false;
        }
      }

      return $this->validationResult;
    }


    /**
     * @return string
     */
    public function getValue() {
      return $this->value;
    }


    /**
     * @return \Fiv\Form\Validator\Base[]
     */
    public function getValidators() {
      return $this->validators;
    }


    /**
     * @return array
     */
    public function getValidatorsErrors() {
      $errors = [];
      foreach ($this->validators as $validator) {
        $errors = array_merge($errors, $validator->getErrors());
      }

      return $errors;
    }


    /**
     * @deprecated use addValidator(new \Fiv\Form\Validator\Required()) instead
     * @see addValidator
     * @return $this
     */
    public function required() {
      trigger_error('Deprecated', E_USER_DEPRECATED);
      return $this->addValidator(new \Fiv\Form\Validator\Required());
    }
  }