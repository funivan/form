<?php

  /**
   * @author Ivan Shcherbak <dev@funivan.com>
   */
  namespace Fiv\Form;

  /**
   * Class Submit
   * Generate <input type="submit" /> element
   *
   * @package Fiv\Form
   */
  class Submit extends Element\InlineInput {

    /**
     * @return string
     */
    protected function getType() {
      return 'submit';
    }

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

  }