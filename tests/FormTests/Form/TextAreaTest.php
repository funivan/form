<?php

  namespace FormTests\Form;

  use Fiv\Form\Form;

  /**
   * @package FormTests\Form
   */
  class TextAreaTest extends \FormTests\Main {

    /**
     * @return \Fiv\Form\TextArea
     */
    protected function getElement() {
      $form = new Form();
      return $form->textarea("test");
    }

    public function testRender() {
      $element = $this->getElement();
      $this->assertContains("<textarea", (string)$element);
      $this->assertContains("</textarea", (string)$element);

      $element->setValue("custom data");
      $this->assertContains(">custom data<", $element->render());
    }

    public function testAttributes() {
      $element = $this->getElement();
      $element->setAttributes([]);
      $this->assertEquals('', $element->renderAttributes());
    }

  }