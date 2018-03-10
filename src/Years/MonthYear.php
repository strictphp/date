<?php

namespace Strict\Date\Years;

use Strict\Date\MonthInterface;


/**
 * [Class] Month Based Year
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Strict PHP Project. All Rights Reserved.
 * @package strictphp/date
 * @since 1.0.0
 */
class MonthYear
    extends UnixTimeYear
{
    public function __construct(MonthInterface $month)
    {
        parent::__construct($month->getTimeStamp());
    }
}