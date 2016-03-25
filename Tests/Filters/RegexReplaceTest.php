<?php


  namespace Tests\Fiv\Form\Filters;

  use Fiv\Form\Filter\RegexReplace;
  use Fiv\Form\Filter\Trim;
  use Fiv\Form\Form;

  /**
   * @package Tests\Form\Filters
   * @author Ivan Shcherbak <dev@funivan.com> 2016
   */
  class RegexReplaceTest extends \Tests\Fiv\Form\FormTestCase {


    public function testSimpleReplace() {

      $filter = new RegexReplace('!\s{2,}!', ' ');
      $value = $filter->apply('hello    world');
      $this->assertEquals('hello world', $value);
    }


    public function testFilterWithForm() {

      $form = new Form();
      $form->setName('test_form');

      $form->input('text')->addFilter(new RegexReplace('!\s{2,}!', ' '))->addFilter(new Trim());

      $form->setData([
        'test_form' => 1,
        'text' => 'hello    world         ',
      ]);

      $this->assertTrue($form->isValid());


      $this->assertEquals('hello world', $form->getElements()['text']->getValue());
    }


  }