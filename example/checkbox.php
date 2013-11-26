<?php

  require __DIR__ . '/../vendor/autoload.php';

  class Subscribe extends \Fiv\Form\Form {

    public function init() {
      $this->setMethod('post');

      $this->checkbox('latest', 'Subscribe to news');

      $this->submit('send');

      if ($this->isValid()) {
        $data = $this->getData();
        echo "\n***" . __LINE__ . "***\n<pre>" . print_r($data, true) . "</pre>\n";
      }

    }

  }

  $form = new Subscribe();
  $form->init();

  echo $form;