<?php

  namespace Tests\Fiv\Form\Element;

  /**
   * @author Ivan Shcherbak <dev@funivan.com> 9/17/14
   */
  class HtmlTest extends \Tests\Fiv\Form\FormTestCase {

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

  }
 