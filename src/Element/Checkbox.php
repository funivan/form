<?php

  namespace Fiv\Form\Element;

  use Fiv\Form\Element;
  use Fiv\Form\FormData;

  /**
   * Generate <input type="submit" /> element
   *
   * @author Ivan Shcherbak <dev@funivan.com>
   */
  class Checkbox extends Element\Input {

    protected $attributes = [
      'type' => 'checkbox',
    ];

    /**
     * @var string
     */
    protected $label = '';

    protected $isChecked = false;


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


    /**
     * @return bool
     */
    public function isChecked() {
      return $this->isChecked;
    }


    /**
     * @param bool $isChecked
     * @return $this
     */
    public function setChecked($isChecked) {
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
    public function setLabel($text) {
      $this->label = $text;
      return $this;
    }


    /**
     * @return string
     */
    public function render() {
      return '<label>' . static::tag($this->tag, $this->attributes) . $this->label . '</label>';
    }


    /**
     * @return $this
     * @deprecated
     */
    public function check() {
      trigger_error('Deprecated', E_USER_DEPRECATED);
      $this->setChecked(true);
      return $this;
    }


    /**
     * Set value to 0
     * @return $this
     * @deprecated
     */
    public function unCheck() {
      trigger_error('Deprecated', E_USER_DEPRECATED);
      $this->setChecked(false);
      return $this;
    }


    /**
     * @deprecated
     */
    public function getValue() {
      return $this->isChecked() ? 1 : 0;
    }


    /**
     * @deprecated
     */
    public function setValue($value) {
      trigger_error('Deprecated', E_USER_DEPRECATED);
      return parent::setValue($value);
    }

  }