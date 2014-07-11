<?php

  include __DIR__ . '/../vendor/autoload.php';

  $form = new \Fiv\Form\Form();
  $form->setMethod('post');

  $form->input('text')->setValue('test');
  $stay = $form->submit('send')->setValue('Stay');
  $goList = $form->submit('send_and_finish')->setValue('Send and list');

  if ($form->isValid()) {

    $data = $form->getData();
    echo "\n***" . __LINE__ . "***\n<pre>" . print_r($data, true) . "</pre>\n";

    if ($form->isClicked($goList)) {
      echo "go list<br>";
    }

    if ($form->isClicked($stay)) {
      echo "stay at this page<br>";
    }

  }

  echo $form;
  die();