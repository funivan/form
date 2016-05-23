<?php

  namespace Tests\Form;

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

  /**
   *
   */
  class AdvancedFormValidationTest extends \PHPUnit_Framework_TestCase {


    /**
     *
     */
    public function testFormValidation() {
      $form = new ExampleMessageForm();
      $form->input('emailFrom');
      $form->input('emailTo');
      $form->input('message');

      $form->setData([
        $form->getUid() => 1,
        'emailFrom' => 'from@test.com',
        'emailTo' => 'to@test.com',
        'message' => 'new message text',
      ]);
      $this->assertTrue($form->isValid());
      $this->assertEquals([], $form->getErrors());

      $form->setData([
        $form->getUid() => 1,
        'emailFrom' => 'from@test.com',
        'emailTo' => 'to@test.com',
        'message' => 'copy message text',
      ]);
      $this->assertFalse($form->isValid());
      $this->assertEquals(['message duplicate error'], $form->getErrors());
    }

  }