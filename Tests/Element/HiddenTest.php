<?php

  namespace Tests\Fiv\Form\Element;

  use Fiv\Form\Element\Input;
  use Fiv\Form\Filter\CallbackFilter;
  use Fiv\Form\Form;

  /**
   * @package Tests\Form\Form
   */
  class HiddenTest extends \PHPUnit_Framework_TestCase {

    /**
     * @return \Fiv\Form\Element\Input
     */
    protected function getElement() {
      $form = new Form();
      return $form->hidden('test');
    }


    public function testRender() {
      $element = $this->getElement();

      $this->assertContains('hidden', (string) $element);
    }


    public function testAttributes() {

      $element = $this->getElement();

      $this->assertEquals('test', $element->getName());
      $this->assertEmpty($element->getClass());

      $element->setClass('hidden_class');
      $this->assertEquals('hidden_class', $element->getClass());

      $element->setAttribute('data-id', 'custom-id');
      $this->assertEquals('custom-id', $element->getAttribute('data-id'));

      $element->removeAttribute('data-id');
      $this->assertEquals(null, $element->getAttribute('data-id'));

    }


    public function testValueWithSlashes() {

      $input = new Input();
      $input->setName('test');
      $input->setType('hidden');
      $value = ' 123"234 \' 44 ';

      $input->addFilter(new CallbackFilter('trim'));

      $input->setValue($value);

      $this->assertContains('<input type="hidden" name="test" value="123&quot;234 &#039; 44"', $input->render());

    }

  }