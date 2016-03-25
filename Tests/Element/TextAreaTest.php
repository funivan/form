<?php

  namespace Tests\Fiv\Form\Element;

  use Fiv\Form\Filter\Trim;
  use Fiv\Form\Form;

  /**
   * @package Tests\Form\Form
   */
  class TextAreaTest extends \PHPUnit_Framework_TestCase {

    /**
     * @return \Fiv\Form\Element\TextArea
     */
    protected function getElement() {
      $form = new Form();
      return $form->textarea('test');
    }

    public function testRender() {
      $element = $this->getElement();
      $this->assertContains('<textarea', (string)$element);
      $this->assertContains('</textarea', (string)$element);

      $element->setValue('custom data');
      $this->assertContains('>custom data<', $element->render());
    }

    public function testAttributes() {
      $element = $this->getElement();
      $element->setAttributes([]);
      $this->assertEquals('', $element->renderAttributes());
    }

    public function testFilter() {
      $element = $this->getElement();
      $element->addFilter(new Trim());

      $this->assertEmpty($element->getValue());

      $element->setValue('test_value');
      $this->assertEquals('test_value', $element->getValue());

      $element->setValue('  other value');
      $this->assertEquals('other value', $element->getValue());
    }

  }