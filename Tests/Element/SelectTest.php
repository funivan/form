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
      $this->assertContains('<select name="lang" ', $selectHtml);
      $this->assertContains('<option value="ru">Russian</option>', $selectHtml);
      $this->assertContains('<option value="ua">Ukrainian</option>', $selectHtml);
      $this->assertContains('</select>', $selectHtml);
    }


    /**
     *
     */
    public function testHandleRequest() {
      $select = new Select();
      $select->setName('lang');
      $select->setOptions(['ru' => 'Russian', 'ua' => 'Ukrainian']);

      $select->handle(new FormData('post', ['lang' => 'ru']));
      $this->assertEquals('ru', $select->getValue());
      $select->handle(new FormData('post', []));
      $this->assertEquals('ru', $select->getValue());
      $select->handle(new FormData('post', ['lang' => 'pl']));
      $this->assertEquals('ru', $select->getValue());
    }
  }