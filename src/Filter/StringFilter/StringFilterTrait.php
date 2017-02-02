<?php

  declare(strict_types=1);

  namespace Fiv\Form\Filter\StringFilter;

  trait StringFilterTrait {

    /**
     * @var StringFilterInterface[]
     */
    private $filters = [];


    /**
     * @param StringFilterInterface $filter
     * @return $this
     */
    public function addFilter(StringFilterInterface $filter) {
      $this->filters[] = $filter;
      return $this;
    }


    private function filterValue(string $value) : string {
      foreach ($this->filters as $filter) {
        $value = $filter->apply($value);
      }
      return $value;
    }
  }