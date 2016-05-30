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

      $this->assertEquals(FormData::METHOD_POST, $data->getMethod());
      $this->assertFalse($data->isMethod(FormData::METHOD_GET));
      $this->assertTrue($data->isMethod(FormData::METHOD_POST));

      $this->assertEquals(['name' => 'petro', 'email' => 'petro@gmail.com'], $data->getData());

      $this->assertEquals('petro', $data->get('name'));
      $this->assertNull($data->get('age'));

      $this->assertTrue($data->has('email'));
      $this->assertFalse($data->has('age'));
    }


    public function testDefaultValue() {
      $data = new FormData(FormData::METHOD_POST, []);
      $this->assertEquals(123, $data->get('test', 123));
      $this->assertNull($data->get('test'));
    }
  }