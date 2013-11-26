<?php


  require __DIR__ . '/../vendor/autoload.php';

  class Languages extends \Fiv\Form\Form {

    public function init() {
      $this->setMethod('post');

      $checkbox = $this->checkboxList('languages', 'Select your languages');
//      $checkbox->addValidator(\Fiv\Form\Validator\Required::i());
      $checkbox->setOptions([
        'en' => 'En',
        'ru' => 'Ru',
        'uk' => 'Uk',
      ]);

      // default checked elements
      $checkbox->setChecked(['uk', 'ru', 'en']);
      $this->submit('send')->setValue('save');
    }

  }

  $form = new Languages();
  $form->init();

  if ($form->isSubmitted()) {
    if ($form->isValid()) {
      $data = $form->getData();
      echo "\n***" . __LINE__ . "***\n<pre>" . print_r($data, true) . "</pre>\n";
    } else {
      foreach ($form->getElements() as $element) {
        foreach ($element->getValidatorsErrors() as $error) {
          echo '<span style="color:red">' . $error . '</span>';
        }
      }
    }

  }

  echo $form;