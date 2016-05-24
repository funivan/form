<?php

  namespace Fiv\Form\Filter;

  /**
   *
   */
  class CallbackFilter implements FilterInterface {

    /**
     * @var callable
     */
    protected $callback;


    /**
     * @param callable $callback
     */
    public function __construct(callable $callback) {
      $this->callback = $callback;
    }


    /**
     * @inheritdoc
     */
    public function apply($value) {
      return call_user_func($this->callback, $value);
    }

  }