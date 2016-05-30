# Changelog

##[Unreleased] 2016-05-25
### Added
- Add method `Form::getErors`
- #25 class `FormData`
- #25 function `Form::handle($formData)`
- #25 function `ElementInterface::handle($formData)`
- function `CheckBoxList::isChecked($value)` (to know is some value is checked)
- `Form` do not set value to each element item anymore. It just provide `FormData` object to elements by `Form::handle`

### Deprecated
- #25 function `Form::setData` will be removed in next release. Please, use `Form::handle`.

### Fixed
- function `CheckBoxList::getValue` always should return array of values

## [Unreleased] 0.1.0-alpha.4
### Added
- #22 Store validation errors to the form
- #13 Add CallbackFilter
### Deprecated
- #26 Deprecate `\Fiv\Form\Filter\Trim`

## 0.1.0-alpha3 [2016-03-25]

### Changed
- Default method is post
- Render hidden elements on start
- \Fiv\Form\setElement changed to public
- \Fiv\Form\Element\BaseElement::addValidator changed signature. Pass only 1 validator
- \Fiv\Form\Element\BaseElement::addFilter changed signature. Pass only 1 filter


### Added
- \Fiv\Form::addElement
- \Fiv\Form\Element\Html::getTag
- \Fiv\Form\Element\Html::setTag
- \Fiv\Form\Element\Html::getAttributes

### Deprecated
- \Fiv\Form\Element\Html::getAttributesAsString use \Fiv\Form\Element\Html::renderAttributes
- \Fiv\Form\Element\Base use \Fiv\Form\Element\BaseElement
- \Fiv\Form\Element\Validator\Len
- \Fiv\Form\Element\BaseElement::required use validator instead
- \Fiv\Form\BaseElement::validate use \Fiv\Form\BaseElement::isValid
- \Fiv\Form\Checkbox use \Fiv\Form\Element\Checkbox
- \Fiv\Form\CheckboxList use \Fiv\Form\Element\CheckboxList
- \Fiv\Form\Select use \Fiv\Form\Element\Select
- \Fiv\Form\RadioList use \Fiv\Form\Element\RadioList
- \Fiv\Form\Select use \Fiv\Form\Element\Select
- \Fiv\Form\TextArea use \Fiv\Form\Element\TextArea
- \Fiv\Form\Validator\Base::i
- \Fiv\Form\Validator\Base use \Fiv\Form\Validator\BaseValidator
- \Fiv\Form\Filter\Base::i
- \Fiv\Form\Filter use \Fiv\Form\Filter\FilterInterface instead
