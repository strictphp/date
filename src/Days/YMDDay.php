<?php

namespace Strict\Date\Days;

use Strict\Date\Internal\DayAbstract;


/**
 * [Class] YMD Day
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Strict PHP Project. All Rights Reserved.
 * @package strictphp/date
 * @since 1.0.0
 */
class YMDDay
    extends DayAbstract
{
    public function __construct(int $year, int $month, int $day)
    {
        parent::__construct(mktime(0, 0, 0, $month, $day, $year));
    }
}