<?php

namespace Strict\Date\Months;

use Strict\Date\Internal\MonthAbstract;


/**
 * [Class] UnixTime Month
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Strict PHP Project. All Rights Reserved.
 * @package strictphp/date
 * @since 1.0.0
 */
class UnixTimeMonth
    extends MonthAbstract
{
    public function __construct(int $time)
    {
        parent::__construct(strtotime(date('Y-m-01', $time)));
    }
}