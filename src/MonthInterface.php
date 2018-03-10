<?php

namespace Strict\Date;

use IteratorAggregate;
use Strict\Date\Internal\TimeStampContainerInterface;
use Strict\Date\Iterators\DayIterator;


/**
 * [Interface] Month Interface
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Strict PHP Project. All Rights Reserved.
 * @package strictphp/date
 * @since 1.0.0
 */
interface MonthInterface
    extends TimeStampContainerInterface, IteratorAggregate
{
    /**
     * Returns DayInterface points the first day of this month.
     *
     * @return DayInterface
     */
    public function getFirstDay(): DayInterface;

    /**
     * Returns DayInterface points the last day of this month.
     *
     * @return DayInterface
     */
    public function getLastDay(): DayInterface;

    /**
     * Get n-th day.
     *
     * The value of $day must be STRICTLY plus or minus. Zero is not allowed.
     *
     * Suppose $this points 2018-03.
     * The return value of $this->getNthDay(  3) points 2018-03-03.
     * The return value of $this->getNthDay( 31) points 2018-03-31.
     * The return value of $this->getNthDay( 32) points 2018-04-01.
     * The return value of $this->getNthDay( -3) points 2018-03-29 ( 3 days before 2018-04-01).
     * The return value of $this->getNthDay(-31) points 2018-03-01 (31 days before 2018-04-01).
     * The return value of $this->getNthDay(-32) points 2018-02-28 (32 days before 2018-04-01).
     *
     * @param int $day
     * @return DayInterface
     */
    public function getNthDay(int $day): DayInterface;

    /**
     * Returns MonthInterface of the next month.
     *
     * @return MonthInterface
     */
    public function getNextMonth(): MonthInterface;

    /**
     * Returns MonthInterface of the last month.
     *
     * @return MonthInterface
     */
    public function getLastMonth(): MonthInterface;

    /**
     * Returns n months after/before this month.
     *
     * @param int $interval
     * @return MonthInterface
     */
    public function getNMonthsAfter(int $interval): MonthInterface;

    /**
     * Returns DayIterator from the first day to the last day of this month.
     *
     * @return DayIterator
     */
    public function getIterator(): DayIterator;

    /**
     * Returns month.
     *
     * @return int
     */
    public function getMonth(): int;

    /**
     * Returns year.
     *
     * @return int
     */
    public function getYear(): int;

    /**
     * Compare two months.
     *
     * -1 if $this < $comparison
     *  0 if $this = $comparison
     *  1 if $this > $comparison
     *
     * note
     *   Month(2013-03) < Month(2013-04)
     *
     * @param MonthInterface $comparison
     * @return int
     */
    public function compare(MonthInterface $comparison): int;
}