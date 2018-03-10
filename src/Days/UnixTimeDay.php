<?php

namespace Strict\Date\Days;

use Strict\Date\Internal\DayAbstract;


/**
 * [Class] UnixTime Day
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Strict PHP Project. All Rights Reserved.
 * @package strictphp/date
 * @since 1.0.0
 */
class UnixTimeDay
    extends DayAbstract
{
    public function __construct(int $time)
    {
        parent::__construct(strtotime('today', $time));
    }
}