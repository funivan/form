<?php

  /**
   * @author Ivan Shcherbak <dev@funivan.com>
   */
  namespace Fiv\Form\Element;

  /**
   * Class Submit
   * Generate <input type="submit" /> element
   *
   * @package Fiv\Form
   */
  class Submit extends \Fiv\Form\Element\Input {

    /**
     * Check if submit button is clicked
     *
     * @param Submit $submitButton
     * @throws \Exception
     * @return bool
     */
    public function isClicked(Submit $submitButton) {
      throw new \Exception('@todo');
    }


    public function render() {
      $this->setType('submit');
      return parent::render();
    }

  }