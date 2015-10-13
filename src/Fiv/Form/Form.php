<?php


  namespace Fiv\Form;

  use Fiv\Form\Element;
  use Fiv\Form\Element\Submit;

  /**
   * @method Form setAction($action);
   * @method string|null getAction();
   *
   * @method Form setMethod($method)
   *
   * @author Ivan Shcherbak <dev@funivan.com>
   */
  class Form extends Element\Html {

    /**
     * @var null
     * Form "name" attribute
     */
    protected $uid = null;

    /**
     * @var mixed
     */
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
     * @return array
     * @throws \Exception
     */
    public function getData() {
      if (!isset($this->data)) {
        throw new \Exception("Data not exists!");
      }

      return $this->data;
    }


    /**
     * @param array|\Iterator $data
     * @throws \Exception
     */
    public function setData($data) {
      if ($data instanceof \Iterator) {
        $data = iterator_to_array($data);
      }

      if (!is_array($data)) {
        throw new \Exception('Data should be an array');
      }


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
          $data[$name] = $element->getValue();
        }

      }

      $this->data = $data;
    }


    /**
     * @deprecated
     * @todo remove method
     */
    public function prepare() {
      return;
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


    /**
     *
     */
    protected function flushCacheFlags() {
      $this->validResultCache = null;
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

      if (!$this->isSubmitted()) {
        return false;
      }

      $this->validResultCache = true;
      foreach ($this->elements as $element) {
        if (!$element->validate()) {
          $this->validResultCache = false;
        }
      }

      return $this->validResultCache;
    }


    /**
     * Check if form is submitted
     *
     * @return bool
     */
    public function isSubmitted() {
      $data = $this->getData();

      return isset($data[$this->getUid()]);
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
     * @return \Fiv\Form\Element\Input
     */
    public function input($name, $text = null) {
      $input = new Element\Input();
      $input->setName($name);
      $input->setText($text);
      $input->setType('text');
      $this->setElement($input);
      return $input;
    }


    /**
     * @param string $name
     * @param        $text
     * @return \Fiv\Form\Element\Input
     */
    public function password($name, $text = null) {
      $input = new Element\Password();
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
     * @return \Fiv\Form\Element\Input
     */
    public function hidden($name, $value = null) {
      $hidden = new  \Fiv\Form\Element\Input();
      $hidden->setType('hidden');
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
     * @param string $name
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
     * @param null $text
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
      $hidden = new Element\Input();
      $hidden->setType('hidden');
      $hidden->addAttributes(array(
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