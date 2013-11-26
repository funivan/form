<?php

  include __DIR__ . '/../../Autoloader.php';
  spl_autoload_register(array(\Fiv\Autoloader::N, 'autoload'));

  use \Fiv\Form\Validator;
  use \Fiv\Form\Filter;

  class Unique extends \Fiv\Form\Validator\Base {

    protected $error = 'Value must be unique';

    /**
     * @param string $error
     * @return $this
     */
    public function setError($error) {
      $this->error = $error;
      return $this;
    }

    /**
     * @param string $value
     * @return bool
     */
    public function isValid($value) {
      if (in_array($value, ['test', 'daf'])) {
        $this->addError($this->error);
      }
      return !$this->hasErrors();
    }

  }

  /**
   * Example of form with all elements, filters and validators
   */
  class FullForm extends \Fiv\Form\Form {

    public function init() {
      $this->setMethod('post');

      /*
       * Інпут    - опис - імя - значення .1
       * Текст    - опис - імя - значення .1
       *
       * Чекбокс  - опис - імя - значення .1
       *
       * Радіо    - опис - імя : [значення - текст] [значення - текст] .1
       * Селект   - опис - імя : [значення - текст] [значення - текст] .1
       *
       * Чекбокси - опис - імя : [значення - текст] [значення - текст] .2
       *
       */



      # login
      $login = $this->input('login', 'Логін');
      $login->addValidator([
        \Fiv\Form\Validator\Required::i()->setError('заповніть поле "логін"'),
        \Fiv\Form\Validator\Len::i()->min(3, 'Мінімальна довжина %s символи'),
        \Fiv\Form\Validator\Len::i()->max(10, 'Максимальна довжина %s символів'),
        Unique::i()->setError('логін повинен бути унікальним')
      ]);
      $login->addFilter(\Fiv\Form\Filter\Trim::i());

      # checkbox list
      $checkbox = $this->checkboxList('languages', 'Мови на яких ви спілкуєтесь:');
      $checkbox->addValidator(\Fiv\Form\Validator\Required::i());
      $checkbox->setOptions([
        'en' => 'En',
        'ru' => 'Ru',
        'uk' => 'Uk',
      ]);
      $checkbox->setValue(['uk', 'en']);

      $this->checkbox('subscribe', 'Підписка на новини');

      $this->radioList('sex', 'Стать')->setOptions([
        'm' => 'Ч',
        'f' => 'Ж',
      ]);

      $this->select('type', 'Спосіб життя:')
        ->setOptions([
          0 => 'Сумний',
          1 => 'Веселий',
        ])
        ->setValue(1);
      $this->textarea('info')->setText('Коротко про себе');

      $login = $this->input('tel')->setText('Телефон:');
      $login->addValidator(\Fiv\Form\Validator\Len::i()->exact(3, 'Телефон з 3х цифр'));
      $login->addFilter(\Fiv\Form\Filter\Trim::i());
      $login->addFilter(new \Fiv\Form\Filter\RegexReplace('! !', ''));

      $this->submit('send', 'зареєструватись');
    }

  }

  $form = new FullForm();
  $form->init();

  if ($form->isSubmitted()) {
    if ($form->isValid()) {
      $data = $form->getData();
      echo "\n***" . __LINE__ . "***\n<pre>" . print_r($data, true) . "</pre>\n";
    } else {
      foreach ($form->getElements() as $element) {
        foreach ($element->getValidatorsErrors() as $error) {
          echo '<span style="color:red">' . $error . '</span><br>';
        }
      }
    }

  }

  echo $form;

?>
