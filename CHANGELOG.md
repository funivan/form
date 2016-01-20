# Changelog

## [Unreleased]

### Changed
- Default method is post
- \Fiv\Form\setElement changed to public

### Added
- \Fiv\Form\addElement

### Deprecated
- \Fiv\Form\Element\Base use \Fiv\Form\Element\BaseElement
- \Fiv\Form\Element\BaseElement::required
- \Fiv\Form\Validator\Base::i
- \Fiv\Form\Validator\Base use \Fiv\Form\Validator\BaseValidator
- \Fiv\Form\Filter\Base::i
- \Fiv\Form\Filter use \Fiv\Form\Filter\FilterInterface instead

- \Fiv\Form\Element\BaseElement::addValidator use \Fiv\Form\Element\BaseElement::addValidators(array)
- \Fiv\Form\Element\BaseElement::addFilter use \Fiv\Form\Element\BaseElement::addFilters(array)

