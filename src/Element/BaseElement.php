<?php

  namespace Fiv\Form\Element;

  use Fiv\Form\Filter\FilterInterface;
  use Fiv\Form\Validator;
  use Fiv\Form\Validator\ValidatorInterface;

  /**
   * @method addFilters
   * @package Fiv\Form\Element
   * @author Ivan Shcherbak <dev@funivan.com> 2016
   */
  class BaseElement extends \Fiv\Form\Element\Html implements ElementInterface {

    /**
     * @var null|boolean
     */
    protected $validationResult = null;

    /**
     * @var \Fiv\Form\Validator\Base[]
     */
    protected $validators = [];

    /**
     * @var FilterInterface[]
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
     * @param ValidatorInterface $validator
     * @return $this
     */
    public function addValidator(ValidatorInterface $validator) {
      $this->validators[] = $validator;
      return $this;
    }


    /**
     * @return \Fiv\Form\Validator\Base[]
     */
    public function getValidators() {
      return $this->validators;
    }


    /**
     *
     * @param FilterInterface $filter
     * @throws \Exception
     * @return $this
     */
    public function addFilter(FilterInterface $filter) {
      $this->filters[] = $filter;
      return $this;
    }


    /**
     * @return FilterInterface[]
     */
    public function getFilters() {
      return $this->filters;
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
     * @return string
     */
    public function getValue() {
      return $this->value;
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

        $this->value = $value;
      }

      return parent::setAttribute($name, $value);
    }


    /**
     * Return true if element is valid
     * @return boolean
     */
    public function isValid() {

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
     * @return bool
     */
    public function validate() {
      trigger_error('Deprecated. Use isValid', E_USER_DEPRECATED);
      return $this->isValid();
    }


    /**
     * @return array
     */
    public function getValidatorsErrors() {
      $errors = [];
      foreach ($this->validators as $validator) {
        foreach ($validator->getErrors() as $error) {
          $errors[] = $error;
        }
      }

      return $errors;
    }


    /**
     * @inheritdoc
     */
    public function render() {
      $value = $this->getValue();
      $this->attributes['value'] = htmlentities($value, ENT_QUOTES);
      return parent::render();
    }


    /**
     * @deprecated
     * @see addValidator
     * @return $this
     */
    public function required() {
      trigger_error('Deprecated', E_USER_DEPRECATED);
      return $this->addValidator(new \Fiv\Form\Validator\Required());
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
     * @param string $name
     * @return $this
     */
    public function setName($name) {
      $this->setAttribute('name', $name);
      return $this;
    }


    /**
     * @return null|string
     */
    public function getName() {
      return $this->getAttribute('name');
    }


    /**
     * @param string $class
     * @return $this
     */
    public function setClass($class) {
      $this->setAttribute('class', $class);
      return $this;
    }


    /**
     * @return null|string
     */
    public function getClass() {
      return $this->getAttribute('class');
    }


    /**
     * @param string $id
     * @return $this
     */
    public function setId($id) {
      $this->setAttribute('id', $id);
      return $this;
    }


    /**
     * @return null|string
     */
    public function getId() {
      return $this->getAttribute('id');
    }

  }