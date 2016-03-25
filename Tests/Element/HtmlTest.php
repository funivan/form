<?php

  namespace Tests\Fiv\Form\Element;

  use Fiv\Form\Element\Html;

  /**
   * @author Ivan Shcherbak <dev@funivan.com> 9/17/14
   */
  class HtmlTest extends \PHPUnit_Framework_TestCase {

    public function testAddClass() {
      $htmlElement = new \Fiv\Form\Element\Html();

      $currentClassName = $htmlElement->getAttribute('class');

      $this->assertEmpty($currentClassName);

      $htmlElement->addClass('test');
      $this->assertEquals('test', $htmlElement->getAttribute('class'));

      $htmlElement->setAttribute('class', '');
      $this->assertEmpty($htmlElement->getAttribute('class'));

      $htmlElement->setAttribute('class', 'custom_class');
      $this->assertEquals("custom_class", $htmlElement->getAttribute('class'));

      $htmlElement->addClass('other_class');
      $this->assertEquals('custom_class other_class', $htmlElement->getAttribute('class'));
    }


    public function testTag() {

      $imgHtml = \Fiv\Form\Element\Html::tag('img', [
        'src' => "/images/logo.png",
        'title' => "logo",
      ]);

      $this->assertTrue((boolean) preg_match("!/>!", $imgHtml));
      $this->assertTrue((boolean) preg_match("!title=!", $imgHtml));
      $this->assertTrue((boolean) preg_match("!src=!", $imgHtml));
    }


    public function testAttributes() {

      $tag = new Html();
      $tag->setTag('input');
      $tag->setAttributes([
        'value' => 123,
      ]);
      $tag->addClass('test');
      $tag->addClass('other');

      $this->assertEquals(['value' => 123, 'class' => 'test other'], $tag->getAttributes());

    }

  }
 