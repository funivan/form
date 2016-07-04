<?php

  namespace Fiv\Form\Element;

  use Fiv\Form\Element;
  use Fiv\Form\FormData;

  /**
   * Generate <input type="submit" /> element
   *
   * @author Ivan Shcherbak <dev@funivan.com>
   * @package Fiv\Form
   */
  class Checkbox extends Element\Input {

    /**
     * @var int
     */
    protected $value = 0;

    /**
     * @var string
     */
    protected $label = '';

    /**
     * @var array
     */
    protected $attributes = [
      'type' => 'checkbox',
    ];


    /**
     * @inheritdoc
     */
    public function handle(FormData $data) {
      $value = $data->get($this->getName());
      $value = ($value === null) ? 0 : (int) $value;
      $this->setValue($value);
    }


    /**
     * Value in checkbox can be true or false
     *
     * @param int $value
     * @return $this
     */
    public function setValue($value) {
      if ($value !== 1 and $value !== 0) {
        throw new \InvalidArgumentException('Expect int: 1 or 0');
      }

      if ($value === 1) {
        return $this->check();
      } else {
        return $this->unCheck();
      }

    }


    /**
     * @return $this
     */
    public function check() {
      $this->setAttribute('checked', 'checked');
      parent::setValue(1);
      return $this;
    }


    /**
     * Set value to 0
     * @return $this
     */
    public function unCheck() {
      $this->removeAttribute('checked');
      parent::setValue(0);
      return $this;
    }


    /**
     * @return bool
     */
    public function isChecked() {
      return $this->getValue() === 1;
    }


    /**
     * @param string $text
     * @return $this
     */
    public function setLabel($text) {
      $this->label = $text;
      return $this;
    }


    /**
     * @return string
     */
    public function render() {
      return '<label>' . parent::render() . $this->label . '</label>';
    }

  }