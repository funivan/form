<?php

  namespace Fiv\Form\Element;

  /**
   *
   * @author Ivan Shcherbak <dev@funivan.com>
   */
  class Html {

    /**
     * @var string
     */
    protected $tag = '';

    /**
     * @var null|string
     */
    protected $content = null;

    /**
     * @var array
     */
    protected $attributes = [];


    /**
     * @return string
     */
    public function __toString() {
      return $this->render();
    }


    /**
     * @param string $className
     * @return $this
     */
    public function addClass($className) {
      $currentClass = $this->getAttribute('class');

      if (!empty($currentClass)) {
        $className = $currentClass . ' ' . $className;
      }

      $this->setAttribute('class', $className);

      return $this;
    }


    /**
     * @param array $attributes
     * @return string
     */
    public static function renderAttributes(array $attributes = []) {
      $attributesInline = '';
      foreach ($attributes as $name => $value) {
        $attributesInline .= $name . '="' . addslashes($value) . '" ';
      }
      return $attributesInline;
    }


    /**
     *
     * @param string $tag
     * @param array $attributes
     * @param string|null $content
     * @return string
     */
    public static function tag($tag, array $attributes = [], $content = null) {
      $html = '<' . $tag . ' ' . static::renderAttributes($attributes);

      if ($content !== null) {
        $html .= '>' . $content . '</' . $tag . '>';
      } else {
        $html .= ' />';
      }

      return $html;
    }


    /**
     * @return array
     */
    public function getAttributes() {
      return $this->attributes;
    }


    /**
     * @param array $attributes
     * @return $this
     */
    public function setAttributes(array $attributes) {
      foreach ($attributes as $name => $value) {
        $this->setAttribute($name, $value);
      }
      return $this;
    }


    /**
     * Add multiple attributes
     *
     * @param array $attributes
     * @return $this
     */
    public function addAttributes(array $attributes) {
      $this->setAttributes($attributes);
      return $this;
    }


    /**
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function setAttribute($name, $value) {
      $this->attributes[$name] = $value;
      return $this;
    }


    /**
     * @param string $name
     * @return $this
     */
    public function removeAttribute($name) {
      unset($this->attributes[$name]);
      return $this;
    }


    /**
     * @param string $name Attribute name
     * @return string|null
     */
    public function getAttribute($name) {
      return !empty($this->attributes[$name]) ? $this->attributes[$name] : null;
    }


    /**
     * @return string
     */
    public function render() {
      return static::tag($this->tag, $this->attributes, $this->getContent());
    }


    /**
     * @return null|string
     */
    public function getContent() {
      return $this->content;
    }


    /**
     * @return string
     */
    public function getTag() {
      return $this->tag;
    }


    /**
     * @param string $tag
     * @return $this
     */
    public function setTag($tag) {
      if (!is_string($tag)) {
        throw new \InvalidArgumentException('Expect tag to be a valid string');
      }
      $this->tag = $tag;
      return $this;
    }

  }