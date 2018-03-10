<?php

namespace Strict\Date\Internal;

use DomainException;
use Strict\Date\DayInterface;
use Strict\Date\Iterators\DayIterator;
use Strict\Date\Iterators\MonthIterator;
use Strict\Date\MonthInterface;
use Strict\Date\Months\UnixTimeMonth;
use Strict\Date\Months\YMMonth;
use Strict\Date\YearInterface;


/**
 * [(Virtually) Abstract Class] Year
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Strict PHP Project. All Rights Reserved.
 * @package strictphp/date
 * @since 1.0.0
 *
 * @internal
 */
class YearAbstract
    extends TimeStampContainerAbstract
    implements YearInterface
{
    private $firstMonth;
    private $lastMonth;

    /**
     * YearAbstract constructor.
     *
     * @param int $time hour, minute, second, day and month must be zero.
     */
    protected function __construct(int $time)
    {
        parent::__construct($time);
        $this->firstMonth = new UnixTimeMonth($time);
        $this->lastMonth = new YMMonth((int)date('Y', $time), 12);
    }

    /**
     * Returns DayInterface points the first day of this year.
     *
     * @return DayInterface
     */
    public function getFirstDay(): DayInterface
    {
        return $this->firstMonth->getFirstDay();
    }

    /**
     * Returns DayInterface points the last day of this year.
     *
     * @return DayInterface
     */
    public function getLastDay(): DayInterface
    {
        return $this->lastMonth->getLastDay();
    }

    /**
     * Returns DayInterface points the n-th day of this year.
     *
     * The value of $day must be STRICTLY plus or minus. Zero is not allowed.
     *
     * Suppose $this points 2018.
     * The return value of $this->getNthDay(   1) points 2018-01-01.
     * The return value of $this->getNthDay( 365) points 2018-12-31.
     * The return value of $this->getNthDay( 366) points 2019-01-01.
     * The return value of $this->getNthDay(  -1) points 2018-12-31.
     * The return value of $this->getNthDay(-365) points 2018-01-01.
     * The return value of $this->getNthDay(-366) points 2017-12-31.
     *
     * @param int $day
     * @return DayInterface
     */
    public function getNthDay(int $day): DayInterface
    {
        if ($day > 0) {
            return $this->getFirstDay()->getNDaysAfterToday($day - 1);
        } else if ($day < 0) {
            return $this->getLastDay()->getNDaysAfterToday($day + 1);
        }
        throw new DomainException('The value of $day must be STRICTLY plus or minus. Zero is not allowed.');
    }

    /**
     * Returns MonthInterface points the first month of this year.
     *
     * @return MonthInterface
     */
    public function getFirstMonth(): MonthInterface
    {
        return $this->firstMonth;
    }

    /**
     * Returns MonthInterface points the last month of this year.
     *
     * @return MonthInterface
     */
    public function getLastMonth(): MonthInterface
    {
        return $this->lastMonth;
    }

    /**
     * Returns MonthInterface points the n-th month of this year.
     *
     * The value of $month must be STRICTLY plus or minus. Zero is not allowed.
     *
     * Suppose $this points 2018.
     * The return value of $this->getNthMonth(  1) points 2018-01.
     * The return value of $this->getNthMonth( 12) points 2018-12.
     * The return value of $this->getNthMonth( 13) points 2019-01.
     * The return value of $this->getNthMonth( -1) points 2018-12.
     * The return value of $this->getNthMonth(-12) points 2018-01.
     * The return value of $this->getNthMonth(-13) points 2017-12.
     *
     * @param int $month
     * @return MonthInterface
     */
    public function getNthMonth(int $month): MonthInterface
    {
        if ($month > 0) {
            return $this->firstMonth->getNMonthsAfter($month - 1);
        } else if ($month < 0) {
            return $this->lastMonth->getNMonthsAfter($month + 1);
        }
        throw new DomainException('The value of $month must be STRICTLY plus or minus. Zero is not allowed.');
    }

    /**
     * Returns YearInterface of the next year.
     *
     * @return YearInterface
     */
    public function getNextYear(): YearInterface
    {
        return new self(mktime(
            0, 0, 0,
            1, 1, $this->getYear() + 1
        ));
    }

    /**
     * Returns YearInterface of the last year.
     *
     * @return YearInterface
     */
    public function getLastYear(): YearInterface
    {
        return new self(mktime(
            0, 0, 0,
            1, 1, $this->getYear() - 1
        ));
    }

    /**
     * Returns n years after/before this year.
     *
     * @param int $interval
     * @return YearInterface
     */
    public function getNYearsAfter(int $interval): YearInterface
    {
        return new self(mktime(
            0, 0, 0,
            1, 1, $this->getYear() + $interval
        ));
    }

    /**
     * Returns MonthIterator from the first month to the last month of this year.
     *
     * Behave the same way as getMonthIterator();
     *
     * @return MonthIterator
     */
    public function getIterator(): MonthIterator
    {
        return $this->getMonthIterator();
    }

    /**
     * Returns MonthIterator from the first month to the last month of this year.
     *
     * Behave the same way as getIterator();
     *
     * @return MonthIterator
     */
    public function getMonthIterator(): MonthIterator
    {
        return new MonthIterator($this->firstMonth, $this->lastMonth->getNextMonth());
    }

    /**
     * Returns DayIterator from the first day to the last day of this year.
     *
     * @return DayIterator
     */
    public function getDayIterator(): DayIterator
    {
        return new DayIterator($this->getFirstDay(), $this->getLastDay()->getNextDay());
    }

    /**
     * Returns year.
     *
     * @return int
     */
    public function getYear(): int
    {
        return (int)date('Y', $this->time);
    }

    /**
     * Compare two years.
     *
     * -1 if $this < $comparison
     *  0 if $this = $comparison
     *  1 if $this > $comparison
     *
     * note
     *   Year(2012) < Year(2013)
     *
     * @param YearInterface $comparison
     * @return int
     */
    public function compare(YearInterface $comparison): int
    {
        return $this->time <=> $comparison->getTimeStamp();
    }
}