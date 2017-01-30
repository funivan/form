<?php

  namespace Tests\Fiv\Form\Element;

  use Fiv\Form\Element\Hidden;
  use Fiv\Form\FormData;

  class HiddenTest extends \PHPUnit_Framework_TestCase {


    /**
     * @return array
     */
    public function getHandleDataProvider() {
      return [
        [123, null, ''],
        ['', 'abc', 'abc'],
        ['', null, ''],
        ['a', 'd', 'd'],
        [123, 123, '123'],
      ];
    }


    /**
     * @dataProvider getHandleDataProvider
     */
    public function testHandle($input, $post, $expect) {
      $element = new Hidden('test', $input);
      $element->handle(new FormData('POST', ['test' => $post]));
      self::assertSame($expect, $element->getValue());
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