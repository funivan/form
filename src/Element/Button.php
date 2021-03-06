<?php

  namespace Fiv\Form\Element;

  use Fiv\Form\FormData;

  class Button extends BaseElement {

    /**
     * just a button
     */
    const TYPE_BUTTON = 'button';

    /**
     * reset value from each element in form
     */
    const TYPE_RESET = 'reset';

    /**
     * Submit form
     */
    const TYPE_SUBMIT = 'submit';

    protected $isSubmitted = false;

    protected $attributes = [
      'type' => self::TYPE_BUTTON,
    ];


    /**
     * @return $this
     */
    public function handle(FormData $request) {
      $this->isSubmitted = $request->has($this->getName());
      return $this;
    }


    public function isSubmitted() : bool {
      if ($this->getAttribute('type') !== self::TYPE_SUBMIT) {
        return false;
      }
      return $this->isSubmitted;
    }


    public function setType(string $type) : self {
      if (!in_array($type, [self::TYPE_BUTTON, self::TYPE_RESET, self::TYPE_SUBMIT])) {
        throw new \InvalidArgumentException('Invalid button type: ' . $type);
      }
      $this->setAttribute('type', $type);

      return $this;
    }


    /**
     * @return string
     */
    public function render() {
      $html = '<button ' . Html::renderAttributes($this->getAttributes()) . ' >';
      $html .= ($this->getText() ?: 'Button');
      $html .= '</button>';

      return $html;
    }

  }