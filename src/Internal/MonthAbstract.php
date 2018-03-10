<?php

namespace Strict\Date\Internal;

use DomainException;
use Strict\Date\DayInterface;
use Strict\Date\Days\StringDay;
use Strict\Date\Days\UnixTimeDay;
use Strict\Date\Iterators\DayIterator;
use Strict\Date\MonthInterface;


/**
 * [(Virtually) Abstract Class] Month
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Strict PHP Project. All Rights Reserved.
 * @package strictphp/date
 * @since 1.0.0
 *
 * @internal
 */
class MonthAbstract
    extends TimeStampContainerAbstract
    implements MonthInterface
{
    private $firstDay;
    private $lastDay;

    /**
     * MonthAbstract constructor.
     *
     * @param int $time hour, minute, second and day must be zero.
     */
    protected function __construct(int $time)
    {
        parent::__construct($time);
        $this->firstDay = new UnixTimeDay($time);
        $this->lastDay = new StringDay(date('Y-m-t', $time));
    }

    /**
     * Returns DayInterface points the first day of this month.
     *
     * @return DayInterface
     */
    public function getFirstDay(): DayInterface
    {
        return $this->firstDay;
    }

    /**
     * Returns DayInterface points the last day of this month.
     *
     * @return DayInterface
     */
    public function getLastDay(): DayInterface
    {
        return $this->lastDay;
    }

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
     *
     * @throws DomainException
     */
    public function getNthDay(int $day): DayInterface
    {
        if ($day > 0) {
            return $this->firstDay->getNDaysAfterToday($day - 1);
        } else if ($day < 0) {
            return $this->lastDay->getNDaysAfterToday($day + 1);
        }
        throw new DomainException('The value of $day must be STRICTLY plus or minus. Zero is not allowed.');
    }

    /**
     * Returns MonthInterface of the next month.
     *
     * @return MonthInterface
     */
    public function getNextMonth(): MonthInterface
    {
        $time = $this->time;
        return new self(mktime(
            0, 0, 0,
            (int)date('n', $time) + 1,
            1,
            (int)date('Y', $time)
        ));
    }

    /**
     * Returns MonthInterface of the last month.
     *
     * @return MonthInterface
     */
    public function getLastMonth(): MonthInterface
    {
        $time = $this->time;
        return new self(mktime(
            0, 0, 0,
            (int)date('n', $time) - 1,
            1,
            (int)date('Y', $time)
        ));
    }

    /**
     * Returns DayIterator from the first day to the last day of this month.
     *
     * @return DayIterator
     */
    public function getIterator(): DayIterator
    {
        return new DayIterator($this->firstDay, $this->lastDay->getNextDay());
    }

    /**
     * Returns month.
     *
     * @return int
     */
    public function getMonth(): int
    {
        return (int)date('n', $this->time);
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
    public function compare(MonthInterface $comparison): int
    {
        return $this->time <=> $comparison->getTimeStamp();
    }

    /**
     * Returns n months after/before this month.
     *
     * @param int $interval
     * @return MonthInterface
     */
    public function getNMonthsAfter(int $interval): MonthInterface
    {
        return new self(mktime(
            0, 0, 0,
            $this->getMonth() + $interval,
            1,
            $this->getYear()
        ));
    }
}