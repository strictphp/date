<?php

namespace Strict\Date\Tests\TestCases;

use PHPUnit\Framework\TestCase;
use Strict\Date\Days\YMDDay;
use Strict\Date\Iterators\YearIterator;
use Strict\Date\Months\YMMonth;
use Strict\Date\Years\UnixTimeYear;
use Strict\Date\Years\YYear;


class ZZZYearTest
    extends TestCase
{
    public function testBehavior()
    {
        $y1 = new YYear(2018);
        $y2 = new UnixTimeYear($y1->getTimeStamp());
        $y3 = $y1->getNextYear()->getLastYear();
        $y4 = $y2->getNYearsAfter(300)->getNYearsAfter(-300);
        $e1 = $y3->getNYearsAfter(3);
        $e2 = $y4->getNYearsAfter(-3);

        $this->assertEquals(0, $y1->compare($y2));
        $this->assertEquals(0, $y1->compare($y3));
        $this->assertEquals(0, $y1->compare($y4));

        $this->assertEquals(-1, $y1->compare($e1));
        $this->assertEquals(1, $e1->compare($y2));
        $this->assertEquals(1, $y3->compare($e2));
        $this->assertEquals(-1, $e2->compare($y4));

        $this->assertEquals(2021, $e1->getYear());

        $this->assertEquals(0, $y1->getFirstMonth()->compare(new YMMonth(2018, 1)));
        $this->assertEquals(0, $y1->getLastMonth()->compare(new YMMonth(2018, 12)));
        $this->assertEquals(0, $y1->getNthMonth(4)->compare(new YMMonth(2018, 4)));
        $this->assertEquals(0, $y1->getNthMonth(-2)->compare(new YMMonth(2018, 11)));

        $this->assertEquals(0, $y1->getFirstDay()->compare(new YMDDay(2018, 1, 1)));
        $this->assertEquals(0, $y1->getLastDay()->compare(new YMDDay(2018, 12, 31)));
        $this->assertEquals(0, $y1->getNthDay(3)->compare(new YMDDay(2018, 1, 3)));
        $this->assertEquals(0, $y1->getNthDay(-3)->compare(new YMDDay(2018, 12, 29)));

        $months = [];
        foreach ($y1 as $month) {
            $this->assertEquals(2018, $month->getYear());
            $this->assertFalse(isset($months[$month->getMonth()]));
            $months[$month->getMonth()] = true;
        }
        $this->assertEquals(12, count($months));
        for ($i = 1; $i <= 12; $i++) {
            $this->assertTrue(isset($months[$i]));
            unset($months[$i]);
        }
        $this->assertEmpty($months);


        $months = [];
        foreach ($y1->getMonthIterator() as $month) {
            $this->assertEquals(2018, $month->getYear());
            $this->assertFalse(isset($months[$month->getMonth()]));
            $months[$month->getMonth()] = true;
        }
        $this->assertEquals(12, count($months));
        for ($i = 1; $i <= 12; $i++) {
            $this->assertTrue(isset($months[$i]));
            unset($months[$i]);
        }
        $this->assertEmpty($months);

        $days = [];
        foreach ($y1->getDayIterator() as $day) {
            $this->assertEquals(2018, $day->getYear());
            $key = $day->format('md');
            $this->assertFalse(isset($days[$key]));
            $days[$key] = true;
        }
        $this->assertEquals(365, count($days));
        foreach ($y1 as $month) {
            foreach ($month as $day) {
                $key = $day->format('md');
                $this->assertTrue(isset($days[$key]));
                unset($days[$key]);
            }
        }
        $this->assertEmpty($days);
    }

    public function testIteration()
    {
        $y1 = new YYear(2010);
        $y2 = new YYear(2020);

        $yearIterator = new YearIterator($y1, $y2);

        $years = [];
        foreach ($yearIterator as $key => $value) {
            $this->assertTrue($yearIterator->valid());
            $this->assertEquals(0, $key);
            $this->assertFalse(isset($years[$value->getYear()]));
            $years[$value->getYear()] = true;
        }
        $this->assertFalse($yearIterator->valid());
        $this->assertEquals(2020, $yearIterator->current()->getYear());
        $this->assertEquals(10, count($years));

        for ($i = 2010; $i < 2020; $i++) {
            $this->assertTrue(isset($years[$i]));
            unset($years[$i]);
        }
        $this->assertEmpty($years);
    }
}