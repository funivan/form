<?php

  namespace Tests\Fiv\Form\Element;

  use Fiv\Form\Element\Button;
  use Fiv\Form\Form;
  use Fiv\Form\FormData;

  class ButtonTest extends \PHPUnit_Framework_TestCase {

    protected function createTestButton() {
      $button = new Button();
      $button->setName('testButton');
      $button->setType(Button::TYPE_SUBMIT);
      $button->setText('<i></i>Submit');
      $button->addAttributes(['class' => 'testClass']);

      return $button;
    }


    public function testRender() {
      $button = $this->createTestButton();
      $this->assertEquals(
        '<button type="submit" name="testButton" class="testClass"  ><i></i>Submit</button>',
        $button->render()
      );
    }


    public function testSubmitted() {
      $form = new Form();
      $button = $this->createTestButton();
      $form->addElement($button);

      $form->handle(new FormData(FormData::METHOD_POST, [$form->getUid() => '1', 'testButton' => 1]));
      $this->assertTrue($button->isSubmitted());
    }


    public function testNotSubmitted() {
      $form = new Form();
      $button = $this->createTestButton();
      $form->addElement($button);

      $form->handle(new FormData(FormData::METHOD_POST, [$form->getUid() => '1']));
      $this->assertFalse($button->isSubmitted());
    }


    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidType() {
      $button = new Button();
      $button->setType('null');
    }

  }