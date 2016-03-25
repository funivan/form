<?php


  namespace Fiv\Form;

  use Fiv\Form\Element;
  use Fiv\Form\Element\Checkbox;
  use Fiv\Form\Element\CheckboxList;
  use Fiv\Form\Element\Submit;
  use Fiv\Form\Element\TextArea;

  /**
   * @author Ivan Shcherbak <dev@funivan.com>
   */
  class Form extends Element\Html {

    /**
     * @var null|string
     */
    protected $uid = null;

    /**
     * @var boolean|null
     */
    protected $validationResult = null;

    /**
     * @var array|null
     */
    protected $data = null;

    /**
     * @var bool
     */
    protected $isSubmitted = false;

    /**
     * @var Element\BaseElement[]
     */
    protected $elements = [];

    /**
     * Default form attributes
     *
     * @var array
     */
    protected $attributes = [
      'method' => 'post',
    ];


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
      if ($this->data === null) {
        throw new \Exception('Data does not exist!');
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


      $this->cleanValidationFlag();

      $formData = [];
      foreach ($this->elements as $element) {
        $name = $element->getName();

        if ($element instanceof Checkbox) {
          $data[$name] = array_key_exists($name, $data) ? 1 : 0;
        } elseif ($element instanceof CheckboxList) {
          $data[$name] = isset($data[$name]) ? $data[$name] : [];
        }

        if (array_key_exists($name, $data)) {
          $element->setValue($data[$name]);
          $formData[$name] = $element->getValue();
        }

      }

      $this->isSubmitted = isset($data[$this->getUid()]);
      $this->data = $formData;
    }


    /**
     * @return string
     */
    public function getMethod() {
      if (!empty($this->attributes['method'])) {
        return strtolower($this->attributes['method']);
      }

      return null;
    }


    /**
     * @param string $method
     * @return $this
     */
    public function setMethod($method) {
      $this->attributes['method'] = $method;

      return $this;
    }


    /**
     *
     */
    protected function cleanValidationFlag() {
      $this->validationResult = null;
    }


    /**
     * Check if form is submitted and all elements are valid
     *
     * @return boolean
     */
    public function isValid() {
      if ($this->validationResult !== null) {
        return $this->validationResult;
      }

      if (!$this->isSubmitted()) {
        return false;
      }

      $this->validationResult = true;
      foreach ($this->elements as $element) {
        if (!$element->isValid()) {
          $this->validationResult = false;
        }
      }

      return $this->validationResult;
    }


    /**
     * Check if form is submitted
     *
     * @return bool
     */
    public function isSubmitted() {
      return $this->isSubmitted;
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
     * @return Element\BaseElement[]
     */
    public function getElements() {
      return $this->elements;
    }


    /**
     * @param string $name
     * @param string|null $text
     * @return \Fiv\Form\Element\Input
     */
    public function input($name, $text = null) {
      $input = new Element\Input();
      $input->setName($name);
      $input->setText($text);
      $this->addElement($input);
      return $input;
    }


    /**
     * @param string $name
     * @param string|null $text
     * @return \Fiv\Form\Element\Input
     */
    public function password($name, $text = null) {
      $input = new Element\Password();
      $input->setName($name);
      $input->setText($text);
      $this->addElement($input);
      return $input;
    }


    /**
     * @param string $name
     * @param null $text
     * @return Select
     */
    public function select($name, $text = null) {
      $select = new Element\Select();
      $select->setName($name);
      $select->setText($text);
      $this->addElement($select);
      return $select;
    }


    /**
     * @param string $name
     * @param string $text
     * @return RadioList
     */
    public function radioList($name, $text = null) {
      $radio = new Element\RadioList();
      $radio->setName($name);
      $radio->setText($text);
      $this->addElement($radio);
      return $radio;
    }


    /**
     * @param string $name
     * @param null $text
     * @return TextArea
     */
    public function textarea($name, $text = null) {
      $input = new TextArea();
      $input->setName($name);
      $input->setText($text);
      $this->addElement($input);
      return $input;
    }


    /**
     * ```
     * $form->hidden('key', md5($this-user->id . HASH_A);
     * ```
     * @param string $name
     * @param null $value
     * @return \Fiv\Form\Element\Input
     */
    public function hidden($name, $value = null) {
      $hidden = new  \Fiv\Form\Element\Input();
      $hidden->setType('hidden');
      $hidden->setName($name);
      $hidden->setValue($value);
      $this->addElement($hidden);
      return $hidden;
    }


    /**
     * ```
     * $form->submit('register', 'зареєструватись');
     * ```
     * @param string $name
     * @param null $value
     * @return Submit
     */
    public function submit($name, $value = null) {
      $input = new Submit();
      $input->setName($name);
      $input->setValue($value);
      $this->addElement($input);
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
      $this->addElement($checkbox);
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
      $this->addElement($checkbox);
      return $checkbox;
    }


    /**
     * Attach element to this form. Overwrite element with same name
     *
     * @param Element\BaseElement $element
     * @return $this
     */
    public function setElement(Element\BaseElement $element) {
      $this->cleanValidationFlag();
      $this->elements[$element->getName()] = $element;
      return $this;
    }


    /**
     * @param Element\BaseElement $element
     * @return $this
     * @throws \Exception
     */
    public function addElement(Element\BaseElement $element) {
      if (isset($this->elements[$element->getName()])) {
        throw new \Exception('Element with name ' . $element->getName() . ' is already added. Use setElement to overwrite it or change name');
      }

      $this->cleanValidationFlag();
      $this->elements[$element->getName()] = $element;
      return $this;
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
        # skip hidden element
        if ($element instanceof Element\Input and $element->getType() === 'hidden') {
          continue;
        }

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
      $hidden->addAttributes([
        'name' => $this->getUid(),
      ]);
      $hidden->setValue(1);


      # get default attribute
      $method = $this->getMethod();
      $this->setAttribute('method', $method);

      $html = '<form ' . Element\Html::renderAttributes($this->getAttributes()) . '>';
      $html .= $hidden->render();

      # render hidden element
      foreach ($this->elements as $element) {
        if ($element instanceof Element\Input and $element->getType() === 'hidden') {
          $html .= $element->render();
        }
      }


      return $html;
    }


    /**
     * @return string
     */
    public function renderEnd() {
      return '</form>';
    }

  }