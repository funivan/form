<?php

  require __DIR__ . '/../vendor/autoload.php';

  /**
   * Class Form
   */
  class FormWithFilter extends \Fiv\Form\Form {

    /**
     * @var \Fiv\Form\Element\Input
     */
    public $text;

    /**
     * @var \Fiv\Form\Element\Submit
     */
    public $submit;

    /**
     * Add elements
     */
    public function init() {
      $this->setMethod('post');

      # add text field
      $text = $this->input('text');
      $text->addFilter(new \Fiv\Form\Filter\Trim());
      $text->setValue('Trim value');

      $this->text = $text;

      $this->submit = $this->submit('send')->setValue('GO');
    }

  }

  $form = new FormWithFilter();
  $form->init();


  if ($form->isValid()) {
    $data = $form->getData();
    echo 'Form data:';
    foreach ($data as $k => $v) {
      echo $k . '=>|' . $v . "|<br>";
    }
  }
?>



<html>
  <body>
    <div id="form" style="text-align: center;padding:10px;">
      <div>
        Input values with right or left spaces. <br>
        Filter Trim automaticaly remove them <br>
      </div>
      <?= $form->renderStart() ?>

      <div class="elements">
        <?= $form->text->render() ?>
      </div>

      <div class="elements submit">
        <?= $form->submit->render() ?>
        <hr>
      </div>
      <?= $form->renderEnd() ?>
    </div>
  </body>
</html>
