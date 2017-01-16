<?php


  namespace Tests\Fiv\Form\Element;


  use Fiv\Form\Element\RadioList;
  use Fiv\Form\FormData;

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
      self::assertContains('<input name="lang" type="radio" value="ru" ', $elementHtml);
      self::assertContains('<input name="lang" type="radio" value="ua" ', $elementHtml);
    }


    /**
     *
     */
    public function testHandleRequest() {
      $element = new RadioList();
      $element->setName('lang');
      $element->setOptions(['ru' => 'Russian', 'ua' => 'Ukrainian']);

      $element->handle(new FormData('post', ['lang' => 'ru']));
      self::assertEquals('ru', $element->getValue());
      $element->handle(new FormData('post', []));
      self::assertEquals('ru', $element->getValue());
      $element->handle(new FormData('post', ['lang' => 'pl']));
      self::assertEquals('ru', $element->getValue());
    }
  }