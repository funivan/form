<?php


  include __DIR__ . '/../../Autoloader.php';
  spl_autoload_register(array(\Fiv\Autoloader::N, 'autoload'));

  class ChangeStatus extends \Fiv\Form\Form {

    /**
     * @var \Fiv\Form\RadioList
     */
    public $radio;

    /**
     * @var \Fiv\Form\Submit
     */
    public $submit;


    public function init() {
      $this->setMethod('post');

      $block = $this->block();
      $block->setText('Status:');
      $this->radio = $block->radioList('status');

      $this->radio->setOptions([
        1 => 'published',
        2 => 'hidden',
      ])->setValue(2);

      $this->submit = $this->submit('send')->setValue('save');

      if ($this->isValid()) {
        $data = $this->getData();
        echo "\n***" . __LINE__ . "***\n<pre>" . print_r($data, true) . "</pre>\n";
      }

    }

  }

  $form = new ChangeStatus();
  $form->init();

  echo $form;