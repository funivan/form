<?php

  namespace Tests\Fiv\Form;

  use Fiv\Form\Element\BaseElement;
  use Fiv\Form\Element\Hidden;
  use Fiv\Form\Element\Input;
  use Fiv\Form\Element\TextArea;
  use Fiv\Form\Form;
  use Fiv\Form\FormData;
  use Fiv\Form\Validator\CallBackValidator;
  use Fiv\Form\Validator\Required;

  class FormTest extends \PHPUnit_Framework_TestCase {

    public function testIsValidFlush() {
      $form = new Form();
      $form->input('email');

      $form->handle(new FormData('post', [
        $form->getUid() => 1,
        'email' => 'test@test',
      ]));
      self::assertTrue($form->isValid());

      $form->handle(new FormData('post', []));
      self::assertFalse($form->isValid());
    }


    public function testUid() {
      $form = new Form();

      self::assertEquals(32, strlen($form->getUid()));

      $form->setName('test');
      self::assertEquals('test', $form->getUid());
    }


    public function testGetElements() {
      $form = new Form();
      self::assertEmpty($form->getElements());
    }


    public function testFormMethods() {
      $form = new Form();
      self::assertEquals('post', $form->getMethod());

      $form->setMethod('POST');
      self::assertEquals('post', $form->getMethod());

      $form->setMethod('get');
      self::assertEquals('get', $form->getMethod());

      $form->setMethod('put');
      self::assertEquals('put', $form->getMethod());

      $form->setMethod(false);
      self::assertEquals(null, $form->getMethod());

      $form->setAttribute('method', 'test');
      self::assertEquals('test', $form->getMethod());

    }


    /**
     *
     */
    public function testFormRender() {
      $form = new Form();
      self::assertContains('method="post"', $form->render());

      $form = new Form();
      $form->setMethod('get');
      self::assertContains('method="get"', $form->render());
    }


    /**
     *
     */
    public function testIsSubmittedFalse() {
      $form = new Form();
      $form->handle(new FormData('post', []));
      self::assertEquals(false, $form->isSubmitted());
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
      self::assertEquals(true, $form->isSubmitted());

      $form = new Form();
      $form->submit('test-submit', 'test-value');
      $form->handle(new FormData('post', [$form->getUid() => 1]));
      self::assertEquals(true, $form->isSubmitted());
    }


    /**
     *
     */
    public function testValidateWithoutSubmit() {
      $form = new Form();
      $form->setName('test-form');
      self::assertFalse($form->isValid());
      self::assertFalse($form->isSubmitted());
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

      self::assertTrue($form->isSubmitted());
      self::assertTrue($form->isValid());

      $form->handle(new FormData('post', []));
      self::assertFalse($form->isSubmitted());
    }


    /**
     * @expectedException \Exception
     */
    public function testAddElementsWithSameNames() {
      $form = new Form();
      $form->addElement((new Input())->setName('test'));


      self::assertCount(1, $form->getElements());

      $form->addElement((new Input())->setName('test'));
    }


    /**
     *
     */
    public function testSetElementsWithSameNames() {
      $form = new Form();
      $form->setElement((new Input())->setName('test')->setValue('first'));


      /** @var BaseElement[] $elements */
      $elements = $form->getElements();
      self::assertCount(1, $elements);
      self::assertEquals('first', $elements['test']->getValue());

      $form->setElement((new Input())->setName('test')->setValue('second'));

      $elements = $form->getElements();
      self::assertCount(1, $elements);
      self::assertEquals('second', $elements['test']->getValue());

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

      self::assertTrue($form->isValid());
      self::assertEquals(1, $checkedItemsNum);
      self::assertTrue($form->isValid());
      self::assertTrue($form->isValid());

      self::assertEquals(1, $checkedItemsNum);

    }


    public function testRenderStartEnd() {
      $form = new Form();
      $form->addElement(new Hidden('test', '123'));
      $start = $form->renderStart();
      self::assertContains('<input type="hidden" name="test" value="123"', $start);

      self::assertEquals('</form>', $form->renderEnd());
    }


    public function testRenderElements() {
      $form = new Form();
      $form->textarea('text', '123');
      self::assertContains('<dl><dt>123</dt><dd><textarea name="text" ></textarea></dd></dl>', $form->render());
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

      self::assertInstanceOf(Input::class, $form->getElement('email'));
      self::assertInstanceOf(TextArea::class, $form->getElement('desc'));
    }


    public function testFormValidationErrors() {
      $form = new Form();
      $form->input('name')->addValidator((new Required())->setError('name input error'));
      $form->input('email')->addValidator((new Required())->setError('email input error'));

      $form->handle(new FormData('post', [$form->getUid() => 1]));
      self::assertFalse($form->isValid());
      self::assertEquals(['name input error', 'email input error'], $form->getErrors());

      $form->handle(new FormData('post', [
        $form->getUid() => 1,
        'email' => 'test@test.com',
      ]));
      self::assertFalse($form->isValid());
      self::assertEquals(['name input error'], $form->getErrors());

      $form->handle(new FormData('post', [
        $form->getUid() => 1,
        'name' => 'testName',
        'email' => 'test@test.com',
      ]));
      self::assertTrue($form->isValid());
      self::assertEquals([], $form->getErrors());
    }


    public function testReSetData() {
      $form = new Form();
      $nameElement = $form->input('name');
      $emailElement = $form->input('email');
      $ageElement = $form->input('age');

      $form->handle(new FormData('post', [
        $form->getUid() => '1',
        'name' => 'petro',
        'email' => 'test@test.com',
      ]));

      /** @var BaseElement[] $elements */
      $elements = $form->getElements();
      self::assertEquals('test@test.com', $elements['email']->getValue());
      self::assertEquals(
        [
          'petro',
          'test@test.com',
          '',
        ],
        [
          $nameElement->getValue(),
          $emailElement->getValue(),
          $ageElement->getValue(),
        ]
      );

      $form->handle(new FormData('post', [
        $form->getUid() => '1',
        'name' => 'stepan',
      ]));
      self::assertEquals(null, $emailElement->getValue());
      self::assertEquals('stepan', $nameElement->getValue());
    }


    public function testHandleRequest() {
      $emailElement = (new Input())->setName('email');
      $descriptionElement = (new TextArea())->setName('description');

      $form = new Form();
      $form->addElement($emailElement);
      $form->addElement($descriptionElement);
      $form->setMethod('post');

      $form->handle(new FormData('post', [
        $form->getUid() => 1,
        'email' => 'test@test.com',
        'description' => 'some description text',
      ]));
      self::assertTrue($form->isSubmitted());
      self::assertEquals('test@test.com', $emailElement->getValue());
      self::assertEquals('some description text', $descriptionElement->getValue());

      $form->handle(new FormData('post', [
        $form->getUid() => 1,
        'email' => 'test@test.com',
      ]));
      self::assertTrue($form->isSubmitted());
      self::assertEquals('test@test.com', $emailElement->getValue());
      self::assertNull($descriptionElement->getValue());

      $form->handle(new FormData('post', [
        $form->getUid() => '1',
      ]));
      self::assertTrue($form->isSubmitted());
      self::assertNull($emailElement->getValue());
      self::assertNull($descriptionElement->getValue());

      $form->handle(new FormData('post', []));
      self::assertFalse($form->isSubmitted());
    }

  }