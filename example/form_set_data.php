<?php

  include __DIR__ . '/../vendor/autoload.php';

  /*Controller file*/

  $form = new \Fiv\Form\Form();
  $form->setMethod('post');
  $form->setName('user-form');

  $userName = $form->input('user_name')
    ->setAttribute('placeholder', 'Enter your name');

  $userName->addValidator(new \Fiv\Form\Validator\Required());
  $lengthValidator = new Fiv\Form\Validator\Len();
  $lengthValidator->min(4, '< 4');
  $lengthValidator->max(25, '> 25');
  $userName->addValidator($lengthValidator);

  $form->input('user_surname')
    ->setAttribute('placeholder', 'Enter your surname');
  $form->submit('user_save', 'save');
  $form->submit('user_find', 'find');


  $form->setData([
    'user_name' => 'tes',
    'user_surname' => 'testSurname',
    'user-form' => 'find',
  ]);

  if ($form->isValid()) {
    echo "\n---valid";
  }

  /*View file*/
  echo $form->renderStart();
  echo $form->getElements()['user_name']->render();
  echo $form->getElements()['user_surname']->render();
  echo $form->getElements()['user_save']->render();
  echo $form->getElements()['user_find']->render();
  echo $form->renderEnd();
