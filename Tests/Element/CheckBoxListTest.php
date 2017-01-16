<?php


  namespace Tests\Fiv\Form\Element;


  use Fiv\Form\Element\CheckboxList;
  use Fiv\Form\FormData;

  class CheckBoxListTest extends \PHPUnit_Framework_TestCase {


    public function testRendering() {
      $element = new CheckboxList();
      $element->setName('lang');
      $element->setOptions(['ru', 'ua']);

      $element->render();
      self::assertContains(
        '<label><input name="lang[]" type="checkbox" value="0"  />ru</label><label><input name="lang[]" type="checkbox" value="1"  />ua</label>',
        $element->render()
      );
    }


    public function testHandleRequest() {
      $element = new CheckboxList();
      $element->setName('lang');
      $element->setOptions(['ru' => 'Russian', 'ua' => 'Ukrainian']);

      $element->handle(new FormData('post', ['lang' => ['ua']]));

      self::assertEquals(['ua'], $element->getValue());
      self::assertTrue($element->isChecked('ua'));
      self::assertFalse($element->isChecked('ru'));
    }
  }