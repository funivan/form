<?php

  declare(strict_types=1);

  namespace Tests\Filter\StringFilter;

  use Fiv\Form\Filter\StringFilter\TrimFilter;

  class TrimFilterTest extends \PHPUnit_Framework_TestCase {

    /**
     * @return array
     */
    public function getTrimSpacesDataProvider() {
      return [
        ['', ''],
        [' ', ''],
        ['  ', ''],
        ['  a  ', 'a'],
        ['a  ', 'a'],
      ];
    }


    /**
     * @dataProvider getTrimSpacesDataProvider
     */
    public function testTrimSpaces(string $input, string $expect) {
      $filter = new TrimFilter();
      self::assertSame($expect, $filter->apply($input));
    }

  }
