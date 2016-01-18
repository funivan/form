<?php

  namespace Fiv\Form\Element;

  use Fiv\Form\Filter\FilterInterface;
  use Fiv\Form\Form;
  use Fiv\Form\Validator;

  /**
   * @method $this setName($name);
   * @method string getName();
   * @method $this setClass($class);
   * @method string getClass();
   * @method $this setId($id);
   * @method string getId();
   *
   * @author  Ivan Shcherbak <dev@funivan.com>
   * @package Fiv\Form
   */
  abstract class Base extends \Fiv\Form\Element\Html {

    /**
     * @var Form
     */
    protected $form = null;

    /**
     * @var null|string
     */
    protected $value = null;

    /**
     * @var \Fiv\Form\Validator\Base[]
     */
    protected $validators = [];

    /**
     * @var null|boolean
     */
    protected $validationResult = null;

    /**
     * @var \Fiv\Form\Filter\FilterInterface[]
     */
    protected $filters = [];

    /**
     * @var string
     */
    protected $text = '';


    /**
     * @return Form
     */
    public function getForm() {
      return $this->form;
    }


    /**
     * @param Form $form
     * @return $this
     */
    public function setForm(Form $form) {
      $this->form = $form;
      return $this;
    }


    /**
     * Attach validator to current element
     *
     * @param \Fiv\Form\Validator\Base[]|\Fiv\Form\Validator\Base $validator
     * @throws \Exception
     * @return $this
     */
    public function addValidator($validator) {
      if (!is_array($validator)) {
        $validator = array($validator);
      }
      $this->validationResult = null;
      foreach ($validator as $validatorClass) {
        if (!($validatorClass instanceof \Fiv\Form\Validator\Base)) {
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
        $filter = array($filter);
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
     * @param $value
     * @return $this
     */
    public function setValue($value) {
      $this->validationResult = null;

      $filters = $this->getFilters();
      foreach ($filters as $filter) {
        $value = $filter->apply($value);
      }

      $this->value = $value;
      return $this;
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
      $errors = array();
      foreach ($this->validators as $validator) {
        $errors = array_merge($errors, $validator->getErrors());
      }

      return $errors;
    }


    /**
     * @return $this
     */
    public function required() {
      return $this->addValidator(new \Fiv\Form\Validator\Required());
    }


  }