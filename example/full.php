<?php

  include __DIR__ . '/../vendor/autoload.php';

  use Fiv\Form\Filter;
  use Fiv\Form\Validator;

  /**
   *
   */
  class Unique extends \Fiv\Form\Validator\Base {

    /**
     * @var string
     */
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


      # login
      $login = $this->input('login', 'Логін');

      $login->addValidator((new \Fiv\Form\Validator\Required())->setError('заповніть поле "логін"'));
      $login->addValidator((new \Fiv\Form\Validator\Len())->min(3, 'Мінімальна довжина %s символи'));
      $login->addValidator((new \Fiv\Form\Validator\Len())->max(10, 'Максимальна довжина %s символів'));
      $login->addValidator((new Unique())->setError('логін повинен бути унікальним'));

      $login->addFilter(new \Fiv\Form\Filter\Trim());

      # checkbox list
      $checkbox = $this->checkboxList('languages', 'Мови на яких ви спілкуєтесь:');
      $checkbox->addValidator(new \Fiv\Form\Validator\Required);

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
      $login->addValidator((new \Fiv\Form\Validator\Len())->exact(3, 'Телефон з 3х цифр'));
      $login->addFilter(new \Fiv\Form\Filter\Trim());
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
