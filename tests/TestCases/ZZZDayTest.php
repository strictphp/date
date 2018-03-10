<?php

namespace Strict\Date\Tests\TestCases;

use PHPUnit\Framework\TestCase;
use Strict\Date\DayInterface;
use Strict\Date\Days\UnixTimeDay;
use Strict\Date\Days\YMDDay;
use Strict\Date\Iterators\DayIterator;


class ZZZDayTest
    extends TestCase
{
    public function testBehavior()
    {
        $d1 = new YMDDay(2018, 3, 4);
        $d2 = new UnixTimeDay(mktime(3, 3, 4, 3, 4, 2018));
        $d3 = $d1->getNextDay()->getLastDay();
        $d4 = $d2->getNDaysAfterToday(3)->getNDaysAfterToday(-3);
        $e1 = $d3->getNDaysAfterToday(3);
        $e2 = $d4->getNDaysAfterToday(-3);

        $this->assertEquals(0, $d1->compare($d2));
        $this->assertEquals(0, $d1->compare($d3));
        $this->assertEquals(0, $d1->compare($d4));

        $this->assertEquals(-1, $d1->compare($e1));
        $this->assertEquals(1, $e1->compare($d2));
        $this->assertEquals(1, $d3->compare($e2));
        $this->assertEquals(-1, $e2->compare($d4));

        $this->assertEquals(DayInterface::WEEK_SUN, $d1->getWeek());
        $this->assertEquals(DayInterface::WEEK_WED, $e1->getWeek());
        $this->assertEquals(DayInterface::WEEK_THU, $e2->getWeek());

        $this->assertEquals('2018-3-4', $d1->format('Y-n-j'));
    }

    public function testIteration()
    {
        $d1 = new YMDDay(2018, 3, 1);
        $d2 = new YMDDay(2018, 3, 5);

        $dayIterator = new DayIterator($d1, $d2);

        foreach ($dayIterator as $key => $value) {
            $this->assertEquals(0, $key);
        }

        $dayIterator->rewind();
        $this->assertTrue($dayIterator->valid());
        $this->assertEquals(0, $dayIterator->current()->compare($d1));

        $dayIterator->next();
        $this->assertTrue($dayIterator->valid());
        $this->assertEquals(0, $dayIterator->current()->compare($d1->getNextDay()));

        $dayIterator->next();
        $this->assertTrue($dayIterator->valid());
        $this->assertEquals(0, $dayIterator->current()->compare($d1->getNDaysAfterToday(2)));

        $dayIterator->next();
        $this->assertTrue($dayIterator->valid());
        $this->assertEquals(0, $dayIterator->current()->compare($d1->getNDaysAfterToday(3)));

        $dayIterator->next();
        $this->assertFalse($dayIterator->valid());
        $this->assertEquals(0, $dayIterator->current()->compare($d1->getNDaysAfterToday(4)));

        $dayIterator->next();
        $this->assertFalse($dayIterator->valid());
        $this->assertEquals(0, $dayIterator->current()->compare($d1->getNDaysAfterToday(5)));

        $dayIterator = new DayIterator($d2, $d1);
        $count = 0;
        foreach ($dayIterator as $key => $value) $count++;
        $this->assertEquals(0, $count);
    }
}