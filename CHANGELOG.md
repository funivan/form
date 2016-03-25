# Changelog

## [Unreleased]

### Changed
- Default method is post
- Render hidden elements on start
- \Fiv\Form\setElement changed to public
- \Fiv\Form\Element\BaseElement::addValidator changed signature. Pass only 1 validator
- \Fiv\Form\Element\BaseElement::addFilter changed signature. Pass only 1 filter


### Added
- \Fiv\Form\addElement

### Deprecated
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
