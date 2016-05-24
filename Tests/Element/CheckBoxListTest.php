<?php


  namespace Tests\Fiv\Form\Element;


  use Fiv\Form\Element\CheckboxList;
  use Fiv\Form\RequestContext;

  class CheckBoxListTest extends \PHPUnit_Framework_TestCase {


    public function testRendering() {
      $element = new CheckboxList();
      $element->setName('lang');
      $element->setOptions(['ru', 'ua']);

      $element->render();
      $this->assertContains(
        '<label><input name="lang[]" type="checkbox" value="0"  />ru</label><label><input name="lang[]" type="checkbox" value="1"  />ua</label>',
        $element->render()
      );
    }


    public function testHandleRequest() {
      $element = new CheckboxList();
      $element->setName('lang');
      $element->setOptions(['ru' => 'Russian', 'ua' => 'Ukrainian']);

      $element->handleRequestContext(new RequestContext('post', ['lang' => ['ua']]));
      
      $this->assertEquals(['ua'], $element->getValue());
      $this->assertTrue($element->isChecked('ua'));
      $this->assertFalse($element->isChecked('ru'));
    }
  }