<?php

namespace Strict\Date;

use IteratorAggregate;
use Strict\Date\Internal\TimeStampContainerInterface;
use Strict\Date\Iterators\DayIterator;
use Strict\Date\Iterators\MonthIterator;


/**
 * [Interface] Year Interface
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Strict PHP Project. All Rights Reserved.
 * @package strictphp/date
 * @since 1.0.0
 */
interface YearInterface
    extends TimeStampContainerInterface, IteratorAggregate
{
    /**
     * Returns DayInterface points the first day of this year.
     *
     * @return DayInterface
     */
    public function getFirstDay(): DayInterface;

    /**
     * Returns DayInterface points the last day of this year.
     *
     * @return DayInterface
     */
    public function getLastDay(): DayInterface;

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
    public function getNthDay(int $day): DayInterface;

    /**
     * Returns MonthInterface points the first month of this year.
     *
     * @return MonthInterface
     */
    public function getFirstMonth(): MonthInterface;

    /**
     * Returns MonthInterface points the last month of this year.
     *
     * @return MonthInterface
     */
    public function getLastMonth(): MonthInterface;

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
    public function getNthMonth(int $month): MonthInterface;

    /**
     * Returns YearInterface of the next year.
     *
     * @return YearInterface
     */
    public function getNextYear(): YearInterface;

    /**
     * Returns YearInterface of the last year.
     *
     * @return YearInterface
     */
    public function getLastYear(): YearInterface;

    /**
     * Returns n years after/before this year.
     *
     * @param int $interval
     * @return YearInterface
     */
    public function getNYearsAfter(int $interval): YearInterface;

    /**
     * Returns MonthIterator from the first month to the last month of this year.
     *
     * Behave the same way as getMonthIterator();
     *
     * @return MonthIterator
     */
    public function getIterator(): MonthIterator;

    /**
     * Returns MonthIterator from the first month to the last month of this year.
     *
     * Behave the same way as getIterator();
     *
     * @return MonthIterator
     */
    public function getMonthIterator(): MonthIterator;

    /**
     * Returns DayIterator from the first day to the last day of this year.
     *
     * @return DayIterator
     */
    public function getDayIterator(): DayIterator;

    /**
     * Returns year.
     *
     * @return int
     */
    public function getYear(): int;

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
    public function compare(YearInterface $comparison): int;
}