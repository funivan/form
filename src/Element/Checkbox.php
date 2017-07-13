<?php

  namespace Fiv\Form\Element;

  use Fiv\Form\Elements\DataElementInterface;
  use Fiv\Form\FormData;

  /**
   * Generate <input type="submit" /> element
   *
   * @author Ivan Shcherbak <dev@funivan.com>
   */
  class Checkbox extends Html implements DataElementInterface {

    protected $attributes = [
      'type' => 'checkbox',
    ];

    /**
     * @var string
     */
    protected $label = '';

    protected $isChecked = false;


    public function __construct(string $name, string $label = null) {
      $this->tag = 'input';

      $this->setAttribute('name', $name);
      if ($label !== null) {
        $this->setLabel($label);
      }
    }


    public function isValid() {
      return true;
    }


    /**
     * @inheritdoc
     */
    public function handle(FormData $data) {
      $this->setChecked($data->has($this->getName()));
      return $this;
    }


    public function isChecked() : bool {
      return $this->isChecked;
    }


    public function setChecked(bool $isChecked) : self {
      $this->isChecked = ($isChecked === true);
      if ($this->isChecked) {
        $this->setAttribute('checked', 'checked');
      } else {
        $this->removeAttribute('checked');
      }
      return $this;
    }


    /**
     * @inheritdoc
     */
    public function setAttribute($name, $value) {
      if ($name == 'checked') {
        $this->isChecked = true;
      }
      return parent::setAttribute($name, $value);
    }


    /**
     * @inheritdoc
     */
    public function removeAttribute($name) {
      if ($name == 'checked') {
        $this->isChecked = false;
      }
      return parent::removeAttribute($name);
    }


    /**
     * @param string $text
     * @return $this
     */
    public function setLabel(string $text) : self {
      $this->label = $text;
      return $this;
    }


    /**
     * @return string
     */
    public function render() {
      $label = static::tag('span', ['class' => 'label-text'], $this->label);
      return '<label>' . static::tag($this->tag, $this->attributes) . $label . '</label>';
    }


    /**
     * @return string
     */
    public function getName() {
      return $this->getAttribute('name');
    }


  }