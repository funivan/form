<?php

  namespace Tests\Form;

  use Tests\Fiv\Form\Fixtures\ExampleMessageForm;


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