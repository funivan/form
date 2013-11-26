<?php


  include __DIR__ . '/../../Autoloader.php';
  spl_autoload_register(array(\Fiv\Autoloader::N, 'autoload'));
  $start = microtime(true);

  class Form extends \Fiv\Form\Form {

    public function init() {
      $this->setMethod('post');

      $select = $this->select('status');
      $select->setText('Status');
      $select->setOptions([
        0 => '',
        1 => 'published',
        2 => 'hidden',
      ]);
      $select->setValue(2);

      $this->submit('send')->setValue('send');
    }
  }

  $form = new Form();
  $form->init();

  if ($form->isValid()) {
    $data = $form->getData();
    echo "\n***" . __LINE__ . "***\n<pre>" . print_r($data, true) . "</pre>\n";
  }

  echo $form;
  echo(microtime(true) - $start);