<?php

  namespace FormTests\Form;

  use Fiv\Form\Form;

  /**
   * @package FormTests\Form
   */
  class HiddenTest extends \FormTests\Main {

    /**
     * @return \Fiv\Form\Hidden
     */
    protected function getElement() {
      $form = new Form();
      return $form->hidden("test");
    }

    public function testRender() {
      $element = $this->getElement();

      $this->assertContains("hidden", (string)$element);
    }

    public function testAttributes() {

      $element = $this->getElement();

      $this->assertEquals('test', $element->getName());
      $this->assertEmpty($element->getClass());

      $element->setClass("hidden_class");
      $this->assertEquals("hidden_class", $element->getClass());

      $element->setAttribute('data-id', 'custom-id');
      $this->assertEquals('custom-id', $element->getAttribute('data-id'));

      $element->removeAttribute('data-id');
      $this->assertEquals(null, $element->getAttribute('data-id'));

      $error = null;
      try {
        $element->sendItem();
      } catch (\Exception $error) {
      }
      $this->assertInstanceOf('Exception', $error);
    }
  }