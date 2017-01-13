<?php

  namespace Tests\Fiv\Form\Element;

  use Fiv\Form\Element\Checkbox;
  use Fiv\Form\Form;
  use Fiv\Form\FormData;

  /**
   *
   */
  class CheckboxTest extends \PHPUnit_Framework_TestCase {


    public function testUncheckedSubmit() {
      $checkbox = new Checkbox();
      $checkbox->setName('send_emails');
      $this->assertFalse($checkbox->isChecked());

      $checkbox->setChecked(true);
      $this->assertTrue($checkbox->isChecked());

      $form = new Form();
      $form->setName('test_form');
      $form->addElement($checkbox);

      // use unchecked checkbox
      $form->handle(new FormData('post', [
        'test_form' => 1,
      ]));
      $this->assertFalse($checkbox->isChecked());
    }


    /**
     * @return array
     */
    public function getTestCheckedStateDataProvider() {
      return [
        [
          1
        ],
        [
          '1'
        ],
        [
          'on'
        ],
        [
          0
        ],
        [
          '0'
        ],
      ];
    }


    /**
     * @dataProvider getTestCheckedStateDataProvider
     */
    public function testTestCheckedState($value) {
      $checkbox = new Checkbox();
      $checkbox->setName('send_emails');

      $form = new Form();
      $form->setName('test_form');
      $form->addElement($checkbox);

      $this->assertFalse($checkbox->isChecked());

      // submit checked value
      $form->handle(new FormData('post', [
        'test_form' => 1,
        'send_emails' => $value,
      ]));

      $this->assertTrue($checkbox->isChecked());
    }


    public function testRender() {
      $checkbox = new Checkbox();
      $checkbox->setName('send_emails');
      $this->assertContains('<input type="checkbox" name="send_emails" ', $checkbox->render());
    }


    public function testHandleRequest() {
      $checkbox = new Checkbox();
      $checkbox->setName('test');
      $checkbox->handle(new FormData('post', ['test' => 1]));
      $this->assertTrue($checkbox->isChecked());
      $checkbox->handle(new FormData('post', []));
      $this->assertFalse($checkbox->isChecked());
    }
    
    
    public function testIsValid(){
      $checkbox = new Checkbox();
      $checkbox->setName('send_emails');

      $form = new Form();
      $form->setName('test_form');
      $form->addElement($checkbox);

      // submit checked value
      $form->handle(new FormData('post', [
        'test_form' => 1,
        'send_emails' => 'on',
      ]));
      
      $this->assertTrue($form->isValid());
    }

  }
