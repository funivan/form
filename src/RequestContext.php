<?php


  namespace Fiv\Form;


  /**
   *
   */
  class RequestContext {

    CONST METHOD_GET = 'GET';

    CONST METHOD_POST = 'POST';

    /**
     * @var string
     */
    protected $method = null;

    /**
     * @var array
     */
    protected $attributes = [];


    /**
     * @param string $method
     * @param array $attributes
     */
    public function __construct($method, array $attributes = []) {
      if (!is_string($method)) {
        throw new \InvalidArgumentException('Parameter "method" should be a string,  ' . gettype($method) . ' given.');
      }
      $method = mb_strtoupper($method);
      if (!in_array($method, [self::METHOD_GET, self::METHOD_POST])) {
        throw new \InvalidArgumentException('Invalid http method name.');
      }
      $this->method = $method;
      $this->attributes = $attributes;
    }


    /**
     * @return mixed
     */
    public function getMethod() {
      return $this->method;
    }


    /**
     * @param string $method
     * @return bool
     */
    public function isMethod($method) {
      return $this->method == mb_strtoupper($method);
    }


    /**
     * @param string $name
     * @return bool
     */
    public function has($name) {
      return isset($this->attributes[$name]);
    }


    /**
     * @param string $name
     * @return mixed|null
     */
    public function get($name) {
      return isset($this->attributes[$name]) ? $this->attributes[$name] : null;
    }


    /**
     * @return array
     */
    public function all() {
      return $this->attributes;
    }


  }