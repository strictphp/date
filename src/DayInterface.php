<?php

namespace Strict\Date;

use Strict\Date\Internal\TimeStampContainerInterfaceYMD;


/**
 * [Interface] Day Interface
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Strict PHP Project. All Rights Reserved.
 * @package strictphp/date
 * @since 1.0.0
 */
interface DayInterface
    extends TimeStampContainerInterfaceYMD
{
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