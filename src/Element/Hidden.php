<?php

  declare(strict_types=1);

  namespace Fiv\Form\Element;

  use Fiv\Form\Element\Hidden\HiddenValidatorInterface;
  use Fiv\Form\Elements\DataElementInterface;
  use Fiv\Form\Elements\ValidatableElementInterface;
  use Fiv\Form\FormData;
  use Fiv\Form\Validator\ValidationResult;
  use Fiv\Form\Validator\ValidationResultInterface;

  class Hidden implements DataElementInterface, ValidatableElementInterface {

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value;

    /**
     * @var HiddenValidatorInterface[]
     */
    private $validators = [];


    public function __construct(string $name, string $value = null) {
      $this->name = $name;
      $this->value = $value ?? '';
    }


    public function setValue(string $value) : self {
      $this->value = $value;
      return $this;
    }


    public function getValue() : string {
      return $this->value;
    }


    /**
     * @param FormData $request
     * @return $this
     */
    public function handle(FormData $request) {
      $value = $request->get($this->getName());
      $this->setValue((string) $value);
      return $this;
    }


    /**
     * @return string
     */
    public function getName() {
      return $this->name;
    }


    /**
     * @return string
     */
    public function render() {
      return Html::tag('input', [
        'type' => 'hidden',
        'name' => $this->getName(),
        'value' => htmlentities($this->value, ENT_QUOTES),
      ]);
    }


    public function addValidator(HiddenValidatorInterface $validator) : self {
      $this->validators[] = $validator;
      return $this;
    }


    public function validate() : ValidationResultInterface {

      $validationResult = new ValidationResult();
      foreach ($this->validators as $validator) {
        $result = $validator->validate($this);
        $validationResult->merge($result);
      }

      return $validationResult;
    }

  }