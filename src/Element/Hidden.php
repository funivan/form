<?php

  declare(strict_types=1);

  namespace Fiv\Form\Element;

  use Fiv\Form\Elements\DataElementInterface;
  use Fiv\Form\FormData;

  class Hidden implements DataElementInterface {

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value;


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

  }