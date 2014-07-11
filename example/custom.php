<?php


  require __DIR__ . '/../vendor/autoload.php';

  class Form extends \Fiv\Form\Form {

    /**
     * @var \Fiv\Form\Element\Input
     */
    public $text;

    /**
     * @var \Fiv\Form\Element\Submit
     */
    public $submit;

    /**
     * @var \Fiv\Form\Element\Input
     */
    public $hiddenUid;

    public function init() {
      $this->setMethod('post');

      $this->text = $this->input('text')->setValue('name');

      $this->submit = $this->submit('send', 'send');

      if ($this->isValid()) {
        $data = $this->getData();
        echo "\n***" . __LINE__ . "***\n<pre>" . print_r($data, true) . "</pre>\n";
      }

    }

  }

  $form = new Form();
  $form->init();
?>

<html>
  <body>
    <div id="form" style="text-align: center;">
      <?= $form->renderStart() ?>

      <div class="elements">
        <?= $form->text->render() ?>
        <hr>
      </div>

      <div class="elements submit">
        <?= $form->submit->render() ?>
        <hr>
      </div>

      <?= $form->renderEnd() ?>
    </div>

  </body>
</html>
