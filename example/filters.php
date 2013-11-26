<?php

  require __DIR__ . '/../vendor/autoload.php';

  class Form extends \Fiv\Form\Form {

    /**
     * @var \Fiv\Form\Text
     */
    public $text;

    /**
     * @var \Fiv\Form\Submit
     */
    public $submit;

    /**
     * @var \Fiv\Form\Hidden
     */
    public $hiddenUid;

    public function init() {
      $this->setMethod('post');

      $input = $this->input('text');
      $input->addFilter([
          new \Fiv\Form\Filter\Trim(),
          new \Fiv\Form\Filter\RegexReplace('!\d!', '?')
        ]
      );
      $input->setValue('test aa-009   ');

      $this->submit = $this->submit('send', 'go');

      if ($this->isValid()) {
        $data = $this->getData();
        foreach ($data as $k => $v) {
          echo $k . '=>|' . $v . "|<br>";
        }

        echo "\n***" . __LINE__ . "***\n<pre>" . print_r($data, true) . "</pre>\n";
      }

    }

  }

  $form = new Form();
  $form->init();
  echo "replace right and left spaces. And replace 0-9 to ?";
  echo $form;