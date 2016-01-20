# Changelog

## [Unreleased]

### Changed
- Default method is post
- \Fiv\Form\setElement changed to public
- \Fiv\Form\Element\BaseElement::addValidator changed signature. Pass only 1 validator
- \Fiv\Form\Element\BaseElement::addFilter changed signature. Pass only 1 filter


### Added
- \Fiv\Form\addElement

### Deprecated
- \Fiv\Form\Element\Base use \Fiv\Form\Element\BaseElement
- \Fiv\Form\Element\BaseElement::required
- \Fiv\Form\Validator\Base::i
- \Fiv\Form\Validator\Base use \Fiv\Form\Validator\BaseValidator
- \Fiv\Form\Filter\Base::i
- \Fiv\Form\Filter use \Fiv\Form\Filter\FilterInterface instead
