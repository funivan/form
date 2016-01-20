<?php

  namespace FormTests\Form;

  use Fiv\Form\Filter\Trim;
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

    public function testFilter() {
      $element = $this->getElement();
      $element->addFilters([new Trim()]);

      $this->assertEmpty($element->getValue());

      $element->setValue("test_value");
      $this->assertEquals("test_value", $element->getValue());

      $element->setValue("  other value");
      $this->assertEquals("other value", $element->getValue());
    }

  }