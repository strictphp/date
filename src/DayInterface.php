<?php

namespace Strict\Date;

use Strict\Date\Internal\TimeStampContainerInterface;


/**
 * [Interface] Day Interface
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Strict PHP Project. All Rights Reserved.
 * @package strictphp/date
 * @since 1.0.0
 */
interface DayInterface
    extends TimeStampContainerInterface
{
    public const WEEK_SUN = 0;
    public const WEEK_MON = 1;
    public const WEEK_TUE = 2;
    public const WEEK_WED = 3;
    public const WEEK_THU = 4;
    public const WEEK_FRI = 5;
    public const WEEK_SAT = 6;

    /**
     * Returns DayInterface of tomorrow.
     *
     * No boundary check (e.g. 2038)
     *
     * @return DayInterface
     */
    public function getNextDay(): DayInterface;

    /**
     * Returns DayInterface of yesterday.
     *
     * No boundary check (e.g. 1970)
     *
     * @return DayInterface
     */
    public function getLastDay(): DayInterface;

    /**
     * Returns n days after/before today.
     *
     * No boundary check (e.g. 2038)
     *
     * @param int $interval
     * @return DayInterface
     */
    public function getNDaysAfterToday(int $interval): DayInterface;

    /**
     * Returns day of the week.
     *
     * e.g. 2018-07-28 => 6 (Sat)
     *
     * @return int
     */
    public function getWeek(): int;

    /**
     * Returns day.
     *
     * e.g. 2018-07-28 => 28
     *
     * @return int
     */
    public function getDay(): int;

    /**
     * Returns month.
     *
     * e.g. 2018-07-28 => 7
     *
     * @return int
     */
    public function getMonth(): int;

    /**
     * Returns year.
     *
     * e.g. 2018-07-28 => 2018
     *
     * @return int
     */
    public function getYear(): int;

    /**
     * Compare two days.
     *
     * -1 if $this < $comparison
     *  0 if $this = $comparison
     *  1 if $this > $comparison
     *
     * note
     *   Day(2013-03-04) < Day(2013-03-05)
     *
     * @param DayInterface $comparison
     * @return int
     */
    public function compare(DayInterface $comparison): int;
}