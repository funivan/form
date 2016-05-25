<?php

  namespace Tests\Fiv\Form\Filters;

  use Fiv\Form\Filter\CallbackFilter;
  use Fiv\Form\Form;
  use Fiv\Form\RequestContext;

  /**
   *
   */
  class CallbackFilterTest extends \PHPUnit_Framework_TestCase {

    public function testCustomFilter() {

      $filter = new CallbackFilter(function ($value) {
        $value = str_replace(' ', '-', $value);
        $value = trim($value, '-');
        return $value;
      });
      $value = $filter->apply('hello world');
      $this->assertEquals('hello-world', $value);

      $value = $filter->apply('hello world  ');
      $this->assertEquals('hello-world', $value);
    }


    public function testFilterWithForm() {

      $form = new Form();
      $form->setName('test_form');
      $form->input('text')->addFilter(new CallbackFilter('trim'));

      $form->handleRequestContext(new RequestContext('post', [
        'test_form' => 1,
        'text' => ' world         ',
      ]));

      $this->assertTrue($form->isValid());


      $this->assertEquals('world', $form->getElements()['text']->getValue());
    }


  }
