<?php

  namespace Tests\Fiv\Form\Fixtures;

  use Fiv\Form\Form;

  /**
   *
   */
  class ExampleMessageForm extends Form {

    /**
     * @return bool
     */
    public function isValid() {
      if (!parent::isValid()) {
        return false;
      }

      if (
        $this->getElements()['emailFrom']->getValue() == 'from@test.com'
        and $this->getElements()['emailTo']->getValue() == 'to@test.com'
        and $this->getElements()['message']->getValue() == 'copy message text'
      ) {
        $this->validationResult = false;
        $this->addError('message duplicate error');
      }

      return $this->validationResult;
    }

  }