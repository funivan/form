<?php


  namespace Fiv\Form;

  use Fiv\Form\Element;

  /**
   * @method Form setAction($action);
   * @method string|null getAction();
   *
   * @method Form setMethod($method)
   *
   * @author Ivan Shcherbak <dev@funivan.com>
   */
  class Form extends Element\Html {

    protected $uid = null;

    protected $prepareDone = false;

    protected $validResultCache = null;

    /**
     * @var array|null
     */
    protected $data = null;

    /**
     * @var Element\Base[]
     */
    protected $elements = [];

    /**
     * @param $name
     * @return $this
     */
    public function setName($name) {
      $this->uid = $name;
      $this->attributes['name'] = $name;
      return $this;
    }

    /**
     * @param bool $ignoreSubmit
     * @return array
     */
    public function getData($ignoreSubmit = true) {
      $this->prepare();

      $result = $this->data;
      if ($ignoreSubmit) {
        foreach ($this->elements as $el) {
          if ($el instanceof Submit) {
            unset($result[$el->getName()]);
          }
        }

      }

      unset($result[$this->uid]);

      return $result;
    }

    protected function prepare() {
      if ($this->prepareDone !== true) {
        $method = $this->getMethod();
        if ($method == 'post') {
          $data = $_POST;
        } else {
          $data = $_GET;
        }

        if (!empty($data)) {
          # data is key value storage
          $this->flushCacheFlags();

          foreach ($this->elements as $element) {
            $name = $element->getName();

            if ($element instanceof Checkbox) {
              $data[$name] = isset($data[$name]) ? 1 : 0;
            } elseif ($element instanceof CheckboxList) {
              $data[$name] = isset($data[$name]) ? $data[$name] : array();
            }

            if (array_key_exists($name, $data)) {
              $element->setValue($data[$name]);
              $this->data[$name] = $element->getValue();
            }

          }
        }
        $this->prepareDone = true;
      }
    }

    /**
     * @return string
     */
    public function getMethod() {
      if (!empty($this->attributes['method']) and strtolower($this->attributes['method']) == 'post') {
        return 'post';
      } else {
        return 'get';
      }
    }

    protected function flushCacheFlags() {
      $this->validResultCache = null;
      $this->prepareDone = null;

    }

    /**
     * Check if form is submitted and all elements are valid
     *
     * @return bool|null
     */
    public function isValid() {
      if ($this->validResultCache !== null) {
        return $this->validResultCache;
      }

      if ($this->isSubmitted()) {

        $this->validResultCache = 1;
        foreach ($this->elements as $element) {
          if (!$element->validate()) {
            $this->validResultCache = false;
          }
        }
        return $this->validResultCache;
      }

      return false;
    }

    /**
     * Check if form is submitted
     *
     * @return bool
     */
    public function isSubmitted() {
      $this->prepare();
      $uid = $this->getUid();

      if ($this->getMethod() == 'get' and isset($_GET[$uid])) {
        return true;
      }

      return isset($_POST[$uid]);
    }

    /**
     * Return unique id of form
     *
     * @return string
     */
    public function getUid() {
      if (empty($this->uid)) {
        $this->uid = md5(get_called_class());
      }

      return $this->uid;
    }

    /**
     * @return \Fiv\Form\Element\Base[]
     */
    public function getElements() {
      return $this->elements;
    }

    /**
     * @param string $name
     * @param        $text
     * @return Text
     */
    public function input($name, $text = null) {
      $input = new Text();
      $input->setName($name);
      $input->setText($text);
      $this->setElement($input);
      return $input;
    }

    /**
     * Connect element to block and to form
     *
     * @param Element\Base $element
     * @return $this
     */
    protected function setElement(\Fiv\Form\Element\Base $element) {
      $this->flushCacheFlags();
      $this->elements[$element->getName()] = $element;
      return $this;
    }

    /**
     * @param      $name
     * @param null $text
     * @return Select
     */
    public function select($name, $text = null) {
      $select = new Select();
      $select->setName($name);
      $select->setText($text);
      $this->setElement($select);
      return $select;
    }

    /**
     * @param        $name
     * @param string $text
     * @return RadioList
     */
    public function radioList($name, $text = null) {
      $radio = new RadioList();
      $radio->setName($name);
      $radio->setText($text);
      $this->setElement($radio);
      return $radio;
    }

    /**
     * @param      $name
     * @param null $text
     * @return TextArea
     */
    public function textarea($name, $text = null) {
      $input = new TextArea();
      $input->setName($name);
      $input->setText($text);
      $this->setElement($input);
      return $input;
    }

    /**
     * ```
     * $form->hidden('key', md5($this-user->id . HASH_A);
     * ```
     * @param      $name
     * @param null $value
     * @return Hidden
     */
    public function hidden($name, $value = null) {
      $hidden = new Hidden();
      $hidden->setName($name);
      $hidden->setValue($value);
      $this->setElement($hidden);
      return $hidden;
    }

    /**
     * ```
     * $form->submit('register', 'зареєструватись');
     * ```
     * @param      $name
     * @param null $value
     * @return Submit
     */
    public function submit($name, $value = null) {
      $input = new Submit();
      $input->setName($name);
      $input->setValue($value);
      $this->setElement($input);
      return $input;
    }

    /**
     * ```
     * $form->checkbox('subscribe', 'Підписка на новини');
     * ```
     * @param string      $name
     * @param string|null $label
     * @return Checkbox
     */
    public function checkbox($name, $label = null) {
      $checkbox = new Checkbox();
      $checkbox->setName($name);
      $checkbox->setLabel($label);
      $this->setElement($checkbox);
      return $checkbox;
    }

    /**
     * @param string $name
     * @param null   $text
     * @return CheckboxList
     */
    public function checkboxList($name, $text = null) {
      $checkbox = new CheckboxList();
      $checkbox->setName($name);
      $checkbox->setText($text);
      $this->setElement($checkbox);
      return $checkbox;
    }

    /**
     * Render full form
     *
     * @return string
     */
    public function render() {
      return $this->renderStart() . $this->renderElements() . $this->renderEnd();
    }

    /**
     * You can easy rewrite this method for custom design of your forms
     *
     * @return string
     */
    protected function renderElements() {
      $formHtml = '<dl>';

      foreach ($this->elements as $element) {
        $formHtml .=
          '<dt>' . $element->getText() . '</dt>' .
          '<dd>' . $element->render() . '</dd>';
      }

      $formHtml .= '</dl>';
      return $formHtml;
    }

    /**
     * @return string
     */
    public function renderStart() {
      $hidden = new Hidden();
      $hidden->setAttributes(array(
        'name' => $this->getUid(),
      ));
      $hidden->setValue(1);

      return '<form ' . $this->getAttributesAsString() . '>' . $hidden->render();
    }

    /**
     * @return string
     */
    public function renderEnd() {
      return '</form> ';
    }
  }