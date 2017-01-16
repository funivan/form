<?php


  namespace Tests\Fiv\Form\Filters;

  use Fiv\Form\Filter\CallbackFilter;
  use Fiv\Form\Filter\RegexReplace;
  use Fiv\Form\Form;
  use Fiv\Form\FormData;

  class RegexReplaceTest extends \PHPUnit_Framework_TestCase {


    public function testSimpleReplace() {

      $filter = new RegexReplace('!\s{2,}!', ' ');
      $value = $filter->apply('hello    world');
      self::assertEquals('hello world', $value);
    }


    public function testFilterWithForm() {

      $form = new Form();
      $form->setName('test_form');

      $form->input('text')->addFilter(new RegexReplace('!\s{2,}!', ' '))->addFilter(new CallbackFilter('trim'));

      $form->handle(new FormData('post', [
        'test_form' => 1,
        'text' => 'hello    world         ',
      ]));

      self::assertTrue($form->isValid());


      self::assertEquals('hello world', $form->getElements()['text']->getValue());
    }


  }