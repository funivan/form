<?php

  namespace Fiv\Form\Element;

  /**
   *
   * @author  Ivan Shcherbak <dev@funivan.com>
   * @package Fiv\Form\Html
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
     * @param $name
     * @param $arguments
     * @return $this|null
     * @throws \Exception
     */
    public function __call($name, $arguments) {
      if (strpos($name, 'set') === 0 and isset($arguments[0])) {
        $this->attributes[strtolower(substr($name, 3))] = $arguments[0];
        return $this;
      } elseif (strpos($name, 'get') === 0 and !isset($arguments[0])) {
        $key = strtolower(substr($name, 3));
        return isset($this->attributes[$key]) ? $this->attributes[$key] : null;
      } else {
        throw new \Exception('Invalid method: ' . $name);
      }
    }

    /**
     * @param array $attributes
     * @return string
     */
    public static function renderAttributes($attributes = array()) {
      $attributesInline = '';
      foreach ($attributes as $name => $value) {
        $attributesInline .= $name . '="' . addslashes($value) . '" ';
      }
      return $attributesInline;
    }

    /**
     *
     * @param      $tag
     * @param      $attributes
     * @param bool $content
     * @return string
     */
    public static function tag($tag, $attributes, $content = false) {
      $html = '<' . $tag . ' ' . static::renderAttributes($attributes);

      if ($content !== null) {
        $html .= '>' . $content . '</' . $tag . '>';
      } else {
        $html .= ' />';
      }

      return $html;
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function setAttributes(array $attributes) {
      $this->attributes = $attributes;
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
     * @param $name
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
    public function getAttributesAsString() {
      return static::renderAttributes($this->attributes);
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

  }