<?php

  namespace FormTests\Form;

  use Fiv\Form\Form;

  /**
   * @package FormTests\Form
   */
  class FormTest extends \FormTests\Main {

    /**
     *
     */
    public function testIsValidFlush() {
      $form = new Form();
      $form->input('email');

      $form->setData([
        $form->getUid() => 1,
        'email' => 'test@test'
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
    public function testGetElements() {
      $form = new Form();
      $this->assertEmpty($form->getElements());
    }


    /**
     *
     */
    public function testFormMethods() {
      $form = new Form();
      $this->assertEquals('get', $form->getMethod());

      $form->setMethod('post');
      $this->assertEquals('post', $form->getMethod());

      $form->setMethod('t');
      $this->assertEquals('get', $form->getMethod());
    }


    /**
     * @throws \Exception
     */
    public function testIsSubmittedFalse() {
      $form = new Form();
      $form->setData([]);
      $this->assertEquals(false, $form->isSubmitted());
    }

    /**
     * @throws \Exception
     */
    public function testIsSubmittedTrue() {
      $form = new Form();
      $form->setName('test-form');
      $form->setData([
        'test-form' => 1
      ]);
      $this->assertEquals(true, $form->isSubmitted());

      $form = new Form();
      $form->submit('test-submit', 'test-value');
      $form->setData([
        $form->getUid() => 1
      ]);
      $this->assertEquals(true, $form->isSubmitted());
    }


    /**
     *
     */
    public function testThrowExceptionWithoutData() {
      $exception = null;

      try {
        $form = new Form();
        $form->setName('test-form');
        $form->isValid();
      } catch (\Exception $e) {
        $exception = $e;
      }
      
      $this->assertNotEmpty($exception, 'Should throw exception if data not set!');
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

  }