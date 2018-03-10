<?php

namespace Strict\Date\Tests\TestCases;

use PHPUnit\Framework\TestCase;
use Strict\Date\Days\YMDDay;
use Strict\Date\Iterators\MonthIterator;
use Strict\Date\Months\UnixTimeMonth;
use Strict\Date\Months\YMMonth;


class ZZZMonthTest
    extends TestCase
{
    public function testBehavior()
    {
        $m1 = new YMMonth(2018, 3);
        $m2 = new UnixTimeMonth($m1->getTimeStamp());
        $m3 = $m1->getNextMonth()->getLastMonth();
        $m4 = $m2->getNMonthsAfter(10)->getNMonthsAfter(-10);
        $e1 = $m3->getNMonthsAfter(3);
        $e2 = $m3->getNMonthsAfter(-3);

        $this->assertEquals(0, $m1->compare($m2));
        $this->assertEquals(0, $m1->compare($m3));
        $this->assertEquals(0, $m1->compare($m4));

        $this->assertEquals(-1, $m1->compare($e1));
        $this->assertEquals(1, $e1->compare($m2));
        $this->assertEquals(1, $m3->compare($e2));
        $this->assertEquals(-1, $e2->compare($m4));

        $this->assertEquals(2018, $e1->getYear());
        $this->assertEquals(6, $e1->getMonth());

        $this->assertEquals(0, $m1->getFirstDay()->compare(new YMDDay(2018, 3, 1)));
        $this->assertEquals(0, $m1->getLastDay()->compare(new YMDDay(2018, 3, 31)));
        $this->assertEquals(0, $m1->getNthDay(30)->compare(new YMDDay(2018, 3, 30)));
        $this->assertEquals(0, $m1->getNthDay(-30)->compare(new YMDDay(2018, 3, 2)));

        $days = [];
        foreach ($m1->getIterator() as $day) {
            $this->assertEquals(2018, $day->getYear());
            $this->assertEquals(3, $day->getMonth());
            $this->assertFalse(isset($days[$day->getDay()]));
            $days[$day->getDay()] = true;
        }
        for ($i = 1; $i <= 31; $i++) {
            $this->assertTrue(isset($days[$i]));
            unset($days[$i]);
        }
        $this->assertEmpty($days);
    }

    public function testIteration()
    {
        $m1 = new YMMonth(2018, 1);
        $m2 = new YMMonth(2019, 1);

        $monthIterator = new MonthIterator($m1, $m2);

        $months = [];
        foreach ($monthIterator as $key => $value) {
            $this->assertEquals(0, $key);
            $this->assertFalse(isset($months[$value->getMonth()]));
            $months[$value->getMonth()] = true;
        }
        $this->assertFalse($monthIterator->valid());
        $this->assertEquals(2019, $monthIterator->current()->getYear());
        $this->assertEquals(1, $monthIterator->current()->getMonth());

        for ($i = 1; $i <= 12; $i++) {
            $this->assertTrue(isset($months[$i]));
            unset($months[$i]);
        }
        $this->assertEmpty($months);
    }
}