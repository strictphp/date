<?php

namespace Strict\Date\Tests\TestCases;

use PHPUnit\Framework\TestCase;
use Strict\Date\Days\YMDDay;
use Strict\Date\Months\DayMonth;
use Strict\Date\Years\DayYear;
use Strict\Date\Years\MonthYear;


class ZZZXBasedYTest
    extends TestCase
{
    public function testBehavior()
    {
        $day = new YMDDay(2018, 3, 4);

        $month = new DayMonth($day);
        $this->assertEquals(2018, $month->getYear());
        $this->assertEquals(3, $month->getMonth());

        $year = new DayYear($day);
        $this->assertEquals(2018, $year->getYear());

        $year = new MonthYear($month);
        $this->assertEquals(2018, $year->getYear());
    }
}