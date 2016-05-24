<?php


  namespace Tests\Fiv\Form\Element;


  use Fiv\Form\Element\RadioList;
  use Fiv\Form\RequestContext;

  /**
   *
   */
  class RadioListTest extends \PHPUnit_Framework_TestCase {

    /**
     *
     */
    public function testRendering() {
      $element = new RadioList();
      $element->setName('lang');
      $element->setOptions(['ru' => 'Russian', 'ua' => 'Ukrainian']);

      $elementHtml = $element->render();
      $this->assertContains('<input name="lang" type="radio" value="ru" ', $elementHtml);
      $this->assertContains('<input name="lang" type="radio" value="ua" ', $elementHtml);
    }


    /**
     *
     */
    public function testHandleRequest() {
      $element = new RadioList();
      $element->setName('lang');
      $element->setOptions(['ru' => 'Russian', 'ua' => 'Ukrainian']);

      $element->handleRequestContext(new RequestContext('post', ['lang' => 'ru']));
      $this->assertEquals('ru', $element->getValue());
      $element->handleRequestContext(new RequestContext('post', []));
      $this->assertNull($element->getValue());
    }
  }