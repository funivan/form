<?php

  namespace Tests\Fiv\Form;

  use Fiv\Form\Element\Input;
  use Fiv\Form\Element\TextArea;
  use Fiv\Form\Form;
  use Fiv\Form\FormData;
  use Fiv\Form\Validator\CallBackValidator;
  use Fiv\Form\Validator\Required;

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

      $form->handle(new FormData('post', [
        $form->getUid() => 1,
        'email' => 'test@test',
      ]));
      $this->assertTrue($form->isValid());

      $form->handle(new FormData('post', []));
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

      $form->handle(new FormData('post', [
        $form->getUid() => 1,
        'other_custom_data' => 123,
        'email' => 'test@test',
      ]));

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
      $form->handle(new FormData('post', []));
      $this->assertEquals(false, $form->isSubmitted());
    }


    /**
     *
     */
    public function testIsSubmittedTrue() {
      $form = new Form();
      $form->setName('test-form');
      $form->handle(new FormData('post', [
        'test-form' => 1,
      ]));
      $this->assertEquals(true, $form->isSubmitted());

      $form = new Form();
      $form->submit('test-submit', 'test-value');
      $form->handle(new FormData('post', [$form->getUid() => 1]));
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
    public function testHandleRequestContext() {
      $form = new Form();
      $form->setName('test-form');
      $form->handle(new FormData('post', [
        $form->getUid() => 1,
        'other_custom_data' => 123,
        'email' => 'test@test',
      ]));

      $this->assertTrue($form->isSubmitted());
      $this->assertTrue($form->isValid());

      $form->handle(new FormData('post', []));
      $this->assertFalse($form->isSubmitted());
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
      $form->handle(new FormData('post', [
        $form->getUid() => '1',
        'test' => '123',
      ]));

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


    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGetElementByInvalidName() {
      $form = new Form();
      $form->getElement('email');
    }


    public function testGetElementByName() {
      $form = new Form();
      $form->input('email');
      $form->textarea('desc');

      $this->assertInstanceOf(Input::class, $form->getElement('email'));
      $this->assertInstanceOf(TextArea::class, $form->getElement('desc'));
    }


    public function testFormValidationErrors() {
      $form = new Form();
      $form->input('name')->addValidator((new Required())->setError('name input error'));
      $form->input('email')->addValidator((new Required())->setError('email input error'));

      $form->handle(new FormData('post', [$form->getUid() => 1]));
      $this->assertFalse($form->isValid());
      $this->assertEquals(['name input error', 'email input error'], $form->getErrors());

      $form->handle(new FormData('post', [
        $form->getUid() => 1,
        'email' => 'test@test.com',
      ]));
      $this->assertFalse($form->isValid());
      $this->assertEquals(['name input error'], $form->getErrors());

      $form->handle(new FormData('post', [
        $form->getUid() => 1,
        'name' => 'testName',
        'email' => 'test@test.com',
      ]));
      $this->assertTrue($form->isValid());
      $this->assertEquals([], $form->getErrors());
    }


    public function testReSetData() {
      $form = new Form();
      $form->input('name');
      $form->input('email');
      $form->input('age');

      $form->handle(new FormData('post', [
        $form->getUid() => '1',
        'name' => 'petro',
        'email' => 'test@test.com',
      ]));
      $this->assertEquals('test@test.com', $form->getElements()['email']->getValue());
      $this->assertEquals(
        [
          'name' => 'petro',
          'email' => 'test@test.com',
          'age' => ''
        ],
        $form->getData()
      );

      $form->handle(new FormData('post', [
        $form->getUid() => '1',
        'name' => 'stepan',
      ]));
      $this->assertEquals(null, $form->getElement('email')->getValue());
      $this->assertEquals('stepan', $form->getElement('name')->getValue());
    }


    public function testHandleRequest() {
      $form = new Form();
      $form->addElement((new Input())->setName('email'));
      $form->addElement((new TextArea())->setName('description'));
      $form->setMethod('post');

      $form->handle(new FormData('post', [
        $form->getUid() => 1,
        'email' => 'test@test.com',
        'description' => 'some description text',
      ]));
      $this->assertTrue($form->isSubmitted());
      $this->assertEquals('test@test.com', $form->getElement('email')->getValue());
      $this->assertEquals('some description text', $form->getElement('description')->getValue());

      $form->handle(new FormData('post', [
        $form->getUid() => 1,
        'email' => 'test@test.com',
      ]));
      $this->assertTrue($form->isSubmitted());
      $this->assertEquals('test@test.com', $form->getElement('email')->getValue());
      $this->assertNull($form->getElement('description')->getValue());

      $form->handle(new FormData('post', [
        $form->getUid() => '1',
      ]));
      $this->assertTrue($form->isSubmitted());
      $this->assertNull($form->getElement('email')->getValue());
      $this->assertNull($form->getElement('description')->getValue());

      $form->handle(new FormData('post', []));
      $this->assertFalse($form->isSubmitted());
    }

  }