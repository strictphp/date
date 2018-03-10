<?php

namespace Strict\Date\Months;

use Strict\Date\DayInterface;


/**
 * [Class] Day Based Month
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Strict PHP Project. All Rights Reserved.
 * @package strictphp/date
 * @since 1.0.0
 */
class DayMonth
    extends UnixTimeMonth
{
    public function __construct(DayInterface $day)
    {
        parent::__construct($day->getTimeStamp());
    }
}