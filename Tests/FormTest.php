<?php

  namespace Tests\Fiv\Form;

  use Fiv\Form\Element\Input;
  use Fiv\Form\Form;
  use Fiv\Form\Validator\CallBackValidator;

  /**
   * @package Tests\Form\Form
   */
  class FormTest extends \PHPUnit_Framework_TestCase {

    /**
     *
     */
    public function testIsValidFlush() {
      $form = new Form();
      $form->input('email');

      $form->setData([
        $form->getUid() => 1,
        'email' => 'test@test',
      ]);

      $this->assertTrue($form->isValid());

      $form->setData([]);

      $this->assertFalse($form->isValid());
    }


    /**
     *
     */
    public function testUid() {
      $form = new Form();

      $this->assertEquals(32, strlen($form->getUid()));

      $form->setName('test');
      $this->assertEquals('test', $form->getUid());
    }


    /**
     *
     */
    public function testData() {
      $form = new Form();
      $form->input('email');

      $form->setData([
        $form->getUid() => 1,
        'other_custom_data' => 123,
        'email' => 'test@test',
      ]);

      $this->assertEquals([
        'email' => 'test@test',
      ], $form->getData());

    }


    /**
     *
     */
    public function testGetElements() {
      $form = new Form();
      $this->assertEmpty($form->getElements());
    }


    /**
     *
     */
    public function testFormMethods() {
      $form = new Form();
      $this->assertEquals('post', $form->getMethod());

      $form->setMethod('POST');
      $this->assertEquals('post', $form->getMethod());

      $form->setMethod('get');
      $this->assertEquals('get', $form->getMethod());

      $form->setMethod('put');
      $this->assertEquals('put', $form->getMethod());

      $form->setMethod(false);
      $this->assertEquals(null, $form->getMethod());

      $form->setAttribute('method', 'test');
      $this->assertEquals('test', $form->getMethod());

    }


    /**
     *
     */
    public function testFormRender() {
      $form = new Form();
      $this->assertContains('method="post"', $form->render());

      $form = new Form();
      $form->setMethod('get');
      $this->assertContains('method="get"', $form->render());
    }


    /**
     *
     */
    public function testIsSubmittedFalse() {
      $form = new Form();
      $form->setData([]);
      $this->assertEquals(false, $form->isSubmitted());
    }


    /**
     *
     */
    public function testIsSubmittedTrue() {
      $form = new Form();
      $form->setName('test-form');
      $form->setData([
        'test-form' => 1,
      ]);
      $this->assertEquals(true, $form->isSubmitted());

      $form = new Form();
      $form->submit('test-submit', 'test-value');
      $form->setData([
        $form->getUid() => 1,
      ]);
      $this->assertEquals(true, $form->isSubmitted());
    }


    /**
     *
     */
    public function testValidateWithoutSubmit() {
      $form = new Form();
      $form->setName('test-form');
      $this->assertFalse($form->isValid());
      $this->assertFalse($form->isSubmitted());
    }


    /**
     *
     */
    public function testFormSetData() {
      $exception = null;

      try {
        $form = new Form();
        $form->setName('test-form');
        $form->setData(null);
      } catch (\Exception $e) {
        $exception = $e;
      }

      $this->assertNotEmpty($exception, 'Should throw exception if data not array or Iterator!');
    }


    /**
     * @expectedException \Exception
     */
    public function testAddElementsWithSameNames() {
      $form = new Form();
      $form->addElement((new Input())->setName('test'));


      $this->assertCount(1, $form->getElements());

      $form->addElement((new Input())->setName('test'));
    }


    /**
     *
     */
    public function testSetElementsWithSameNames() {
      $form = new Form();
      $form->setElement((new Input())->setName('test')->setValue('first'));


      $elements = $form->getElements();
      $this->assertCount(1, $elements);
      $this->assertEquals('first', $elements['test']->getValue());

      $form->setElement((new Input())->setName('test')->setValue('second'));

      $elements = $form->getElements();
      $this->assertCount(1, $elements);
      $this->assertEquals('second', $elements['test']->getValue());

    }


    public function testFormValidationCache() {
      $form = new Form();
      $form->setName('user_registration');


      $element = (new Input())->setName('test')->setValue('first');

      $checkedItemsNum = 0;

      $element->addValidator(new CallBackValidator(function ($value) use (&$checkedItemsNum) {
        $checkedItemsNum++;

        return !empty($value);
      }));

      $form->setElement($element);
      # emulate form submit
      $form->setData([
        $form->getUid() => '1',
        'test' => '123',
      ]);

      $this->assertTrue($form->isValid());
      $this->assertEquals(1, $checkedItemsNum);
      $this->assertTrue($form->isValid());
      $this->assertTrue($form->isValid());

      $this->assertEquals(1, $checkedItemsNum);

    }


    public function testRenderStartEnd() {
      $form = new Form();
      $form->hidden('test', '123');
      $start = $form->renderStart();
      $this->assertContains('<input type="hidden" name="test" value="123"', $start);

      $this->assertEquals('</form>', $form->renderEnd());
    }


    public function testRenderElements() {
      $form = new Form();
      $form->textarea('text', '123');
      $this->assertContains('<dl><dt>123</dt><dd><textarea name="text" ></textarea></dd></dl>', $form->render());
    }


  }