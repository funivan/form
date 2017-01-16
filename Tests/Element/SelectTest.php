<?php


  namespace Tests\Fiv\Form\Element;


  use Fiv\Form\Element\Select;
  use Fiv\Form\FormData;

  /**
   *
   */
  class SelectTest extends \PHPUnit_Framework_TestCase {

    /**
     *
     */
    public function testRendering() {
      $select = new Select();
      $select->setName('lang');
      $select->setOptions(['ru' => 'Russian', 'ua' => 'Ukrainian']);

      $selectHtml = $select->render();
      self::assertContains('<select name="lang" ', $selectHtml);
      self::assertContains('<option value="ru">Russian</option>', $selectHtml);
      self::assertContains('<option value="ua">Ukrainian</option>', $selectHtml);
      self::assertContains('</select>', $selectHtml);
    }


    /**
     *
     */
    public function testHandleRequest() {
      $select = new Select();
      $select->setName('lang');
      $select->setOptions(['ru' => 'Russian', 'ua' => 'Ukrainian']);

      $select->handle(new FormData('post', ['lang' => 'ru']));
      self::assertEquals('ru', $select->getValue());
      $select->handle(new FormData('post', []));
      self::assertEquals('ru', $select->getValue());
      $select->handle(new FormData('post', ['lang' => 'pl']));
      self::assertEquals('ru', $select->getValue());
    }
  }