<?php


  namespace Fiv\Form;


  /**
   *
   */
  class FormData {

    CONST METHOD_GET = 'GET';

    CONST METHOD_POST = 'POST';

    /**
     * @var string
     */
    protected $method;

    /**
     * @var array
     */
    protected $data;


    /**
     * @param string $method
     * @param array $attributes
     */
    public function __construct($method, array $attributes = []) {
      if (!is_string($method)) {
        throw new \InvalidArgumentException('Parameter "method" should be a string,  ' . gettype($method) . ' given.');
      }
      $method = strtoupper($method);
      if (!in_array($method, [self::METHOD_GET, self::METHOD_POST])) {
        throw new \InvalidArgumentException('Invalid http method name.');
      }
      $this->method = $method;
      $this->data = $attributes;
    }


    /**
     * @return string
     */
    public function getMethod() {
      return $this->method;
    }


    /**
     * @param string $method
     * @return bool
     */
    public function isMethod($method) {
      return $this->method === strtoupper($method);
    }


    /**
     * @param string $name
     * @return bool
     */
    public function has($name) {
      return isset($this->data[$name]);
    }


    /**
     * @param string $name
     * @return mixed|null
     */
    public function get($name) {
      return isset($this->data[$name]) ? $this->data[$name] : null;
    }


    /**
     * @return array
     */
    public function getData() {
      return $this->data;
    }

  }