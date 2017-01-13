# Changelog

## 0.1.0-alpha.7 [Unreleased]
### Changed
  - Drop support of the php 5.6 Minimum version is php 7.0

### Removed
  - #40 Remove old methods: Fiv\Form\Element\Checkbox::unCheck, Fiv\Form\Element\Checkbox::check
  - #45 Remove method `Form::getData`
  
## 0.1.0-alpha.6 [2016-10-17]
### Added
  - #43 `Button` element

## 0.1.0-alpha.5 [2016-09-07]
### Removed
  - #33 Class Fiv\Form\Element\Base
  - #33 Method Fiv\Form\Element\BaseElement::validate
  - #33 Method Fiv\Form\BaseElement::required
  - #33 Method Fiv\Form\Element\Html::__call
  - #33 Method Fiv\Form\Element\Html::getAttributesAsString
  - #33 Class Fiv\Form\Filter\Base
  - #33 Class Fiv\Form\Filter\Trim
  - #33 Class Fiv\Form\Validator\Base
  - #33 Class Fiv\Form\Validator\Len
  - #33 Method Fiv\Form\Validator\BaseValidator::i
  - #33 Class Fiv\Form\Checkbox
  - #33 Class Fiv\Form\CheckboxList
  - #33 Class Fiv\Form\RadioList
  - #33 Class Fiv\Form\Select
  - #33 Class Fiv\Form\TextArea
  - #33 Method Fiv\Form\Form::setData

## 0.1.0-alpha.4 [2016-05-31]
### Added
  - #29 Execute `BaseValidator::flushErrors()` in `BaseValidator::isValid()` function (validators)
  - function `DataElementInterface::getValue()`
  - Add method `Form::getErors`
  - #25 class `FormData`
  - #25 function `Form::handle($formData)`
  - #25 function `DataElementInterface::handle($formData)`
  - function `CheckBoxList::isChecked($value)` (to know is some value is checked)
  - Move `setValue` from the `Form` to the element. Each element `handle` `FormData`
  - #22 Store validation errors to the form
  - #13 Add CallbackFilter

### Changed
 - #29 `Form` always use `DataElementInterface`, not `BaseElement`. Some functional may be inaccessible.
 - #29 Move functions `addValidator()`, `getValidators()`, `addFilter()`, `getFilters()` from `BaseElement` to `DataElementInterface`

### Removed
 - #29 Function `BaseElement::isValid()` do not execute `flushErrors()`. All validators must clear own errors before each validation.
 - #29 Function `BaseValidator::flushErrors()`

### Deprecated
  - #25 function `Form::setData` will be removed in next release. Please, use `Form::handle`.
  - #26 Deprecate `\Fiv\Form\Filter\Trim`

### Fixed
  - function `CheckBoxList::getValue` always return array of values

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
