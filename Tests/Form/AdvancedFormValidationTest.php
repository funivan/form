<?php

  namespace Tests\Form;

  use Fiv\Form\FormData;
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

      $form->handle(new FormData('post', [
        $form->getUid() => 1,
        'emailFrom' => 'from@test.com',
        'emailTo' => 'to@test.com',
        'message' => 'new message text',
      ]));
      self::assertTrue($form->isValid());
      self::assertEquals([], $form->getErrors());

      $form->handle(new FormData('post', [
        $form->getUid() => 1,
        'emailFrom' => 'from@test.com',
        'emailTo' => 'to@test.com',
        'message' => 'copy message text',
      ]));
      self::assertFalse($form->isValid());
      self::assertEquals(['message duplicate error'], $form->getErrors());
    }

  }