<?php

  /**
   * @author Ivan Shcherbak <dev@funivan.com>
   */
  namespace Fiv\Form\Element;

  use Fiv\Form\FormData;

  /**
   * Generate <input type="submit" /> element
   *
   * @author Ivan Shcherbak <dev@funivan.com>
   */
  class Submit extends \Fiv\Form\Element\Input {

    /**
     * @var array
     */
    protected $attributes = [
      'type' => 'submit',
    ];

    /**
     * @var bool
     */
    private $isSubmitted = false;


    /**
     * @inheritdoc
     */
    public function handle(FormData $data) {
      $this->isSubmitted = !empty($data->get($this->getName()));
    }


    /**
     * @return bool
     */
    public function isSubmitted() {
      return $this->isSubmitted;
    }

  }