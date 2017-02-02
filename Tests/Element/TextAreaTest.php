<?php

  namespace Tests\Fiv\Form\Element;

  use Fiv\Form\Element\TextArea;
  use Fiv\Form\Filter\StringFilter\TrimFilter;
  use Fiv\Form\FormData;

  class TextAreaTest extends \PHPUnit_Framework_TestCase {

    /**
     * @return \Fiv\Form\Element\TextArea
     */
    protected function getElement() {
      return new TextArea('text');
    }


    public function testRender() {
      $element = $this->getElement();
      self::assertContains('<textarea', (string) $element->render());
      self::assertContains('</textarea', (string) $element->render());

      $element->setValue('custom data');
      self::assertContains('>custom data<', $element->render());
    }


    public function testFilter() {
      $element = $this->getElement();
      $element->addFilter(new TrimFilter());

      self::assertEmpty($element->getValue());

      $element->setValue('test_value');
      self::assertEquals('test_value', $element->getValue());

      $element->setValue('  other value');
      self::assertEquals('other value', $element->getValue());
    }


    public function testHandleRequest() {
      $element = new TextArea('test');
      $element->handle(new FormData('post', ['test' => 'test text']));
      self::assertEquals('test text', $element->getValue());
      $element->handle(new FormData('post', []));
      self::assertSame('', $element->getValue());
    }

  }