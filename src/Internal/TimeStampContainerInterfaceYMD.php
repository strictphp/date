<?php

namespace Strict\Date\Internal;


/**
 * [Interface] TimeStamp Container Interface with getYear, getMonth and getDay
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Strict PHP Project. All Rights Reserved.
 * @package strictphp/date
 * @since 1.0.0
 *
 * @internal
 */
interface TimeStampContainerInterfaceYMD
    extends TimeStampContainerInterfaceYM
{
    public const WEEK_SUN = 0;
    public const WEEK_MON = 1;
    public const WEEK_TUE = 2;
    public const WEEK_WED = 3;
    public const WEEK_THU = 4;
    public const WEEK_FRI = 5;
    public const WEEK_SAT = 6;

    /**
     * Returns day.
     *
     * @return int
     */
    public function getDay(): int;

    /**
     * Returns day of the week.
     *
     * @return int
     */
    public function getWeek(): int;
}