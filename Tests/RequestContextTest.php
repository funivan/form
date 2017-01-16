<?php


  namespace Tests\Fiv\Form;


  use Fiv\Form\FormData;

  class FormDataTest extends \PHPUnit_Framework_TestCase {

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidHttpMethodValue() {
      new FormData('invalid', []);
    }


    public function testGetters() {
      $testData = [
        'name' => 'petro',
        'email' => 'petro@gmail.com',
      ];
      $data = new FormData(FormData::METHOD_POST, $testData);

      self::assertEquals(FormData::METHOD_POST, $data->getMethod());
      self::assertFalse($data->isMethod(FormData::METHOD_GET));
      self::assertTrue($data->isMethod(FormData::METHOD_POST));

      self::assertEquals(['name' => 'petro', 'email' => 'petro@gmail.com'], $data->getData());

      self::assertEquals('petro', $data->get('name'));
      self::assertNull($data->get('age'));

      self::assertTrue($data->has('email'));
      self::assertFalse($data->has('age'));
    }

  }