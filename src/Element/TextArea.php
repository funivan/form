<?php

  namespace Fiv\Form\Element;

  use Fiv\Form\Elements\StringDataElementInterface;
  use Fiv\Form\Filter\StringFilter\StringFilterTrait;
  use Fiv\Form\FormData;
  use Fiv\Form\Validation\StringValidation\StringValidationTrait;

  /**
   * Generate <textarea></textarea> html tag
   *
   * @author Ivan Shcherbak <dev@funivan.com>
   */
  class TextArea implements StringDataElementInterface {

    use StringFilterTrait;
    use StringValidationTrait;


    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value;

    /**
     * @var string|null
     */
    private $text = null;


    public function __construct(string $name, string $value = null) {
      $this->name = $name;
      $this->value = $value ?? '';
    }


    /**
     * @return string
     */
    public function render() {
      return Html::tag('textarea', [
        'name' => $this->getName(),
      ], $this->value);
    }


    /**
     * @inheritdoc
     */
    public function handle(FormData $data) {
      $this->setValue((string) $data->get($this->getName()));
      return $this;
    }


    public function setValue(string $value) : self {
      $this->value = $this->filterValue((string) $value);
      return $this;
    }


    public function setText(string $text) : self {
      $this->text = $text;
      return $this;
    }


    /**
     * @return string|null
     */
    public function getText() {
      return $this->text;
    }


    public function getValue() : string {
      return $this->value;
    }


    /**
     * @return string
     */
    public function getName() {
      return $this->name;
    }

  }