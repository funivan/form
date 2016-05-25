<?php

  namespace Tests\Fiv\Form\Element;

  use Fiv\Form\Element\Checkbox;
  use Fiv\Form\Form;
  use Fiv\Form\RequestContext;

  /**
   *
   */
  class CheckboxTest extends \PHPUnit_Framework_TestCase {


    public function testUncheckedSubmit() {
      $form = new Form();
      $form->setName('test_form');
      $checkbox = $form->checkbox('send_emails')->check();
      $this->assertEquals(1, $checkbox->getValue());
      $this->assertTrue($checkbox->isChecked());

      // use unchecked checkbox
      $form->handleRequestContext(new RequestContext('post', [
        'test_form' => 1,
      ]));


      $this->assertEmpty($checkbox->getValue());

      $form->handleRequestContext(new RequestContext('post', [
        'test_form' => 1,
        'send_emails' => 1,
      ]));

      $this->assertEquals(1, $checkbox->getValue());

    }


    public function testCheckedState() {
      $form = new Form();
      $form->setName('test_form');
      $checkbox = $form->checkbox('send_emails')->unCheck();
      $this->assertEquals(0, $checkbox->getValue());
      $this->assertFalse($checkbox->isChecked());

      // submit checked value
      $form->handleRequestContext(new RequestContext('post', [
        'test_form' => 1,
        'send_emails' => 1,
      ]));

      $this->assertEquals(1, $checkbox->getValue());
      $this->assertTrue($checkbox->isChecked());

      // submit unchecked value
      $form->handleRequestContext(new RequestContext('post', [
        'test_form' => 1,
        'send_emails' => 0,
      ]));
      $this->assertEquals(0, $checkbox->getValue());
      $this->assertFalse($checkbox->isChecked());
    }


    public function testRender() {
      $checkbox = new Checkbox();
      $checkbox->setName('send_emails');
      $this->assertContains('<input type="checkbox" name="send_emails" value="0" ', $checkbox->render());
    }


    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidValue() {
      $checkbox = new Checkbox();
      $this->assertFalse($checkbox->isChecked());

      $checkbox->setValue(4);

    }


    public function testHandleRequest() {
      $checkbox = new Checkbox();
      $checkbox->setName('test');
      $checkbox->handleRequestContext(new RequestContext('post', ['test' => 1]));
      $this->assertTrue($checkbox->isChecked());
      $checkbox->handleRequestContext(new RequestContext('post', []));
      $this->assertFalse($checkbox->isChecked());
    }

  }
