<?php

  namespace Tests\Fiv\Form\Element;

  use Fiv\Form\Element\Hidden;
  use Fiv\Form\Form;

  class HiddenTest extends \PHPUnit_Framework_TestCase {

    /**
     * @return \Fiv\Form\Element\Input
     */
    protected function getElement() {
      $form = new Form();
      return $form->hidden('test');
    }


    public function testRender() {
      $element = new Hidden('test');

      self::assertEquals('test', $element->getName());
      self::assertContains('hidden', $element->render());
    }


    public function testValueWithSlashes() {

      $input = new Hidden('test', '123"234 \' 44');

      self::assertContains('<input type="hidden" name="test" value="123&quot;234 &#039; 44"', $input->render());
    }

  }