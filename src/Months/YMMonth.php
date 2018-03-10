<?php

namespace Strict\Date\Months;

use Strict\Date\Internal\MonthAbstract;


/**
 * [Class] YM Month
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Strict PHP Project. All Rights Reserved.
 * @package strictphp/date
 * @since 1.0.0
 */
class YMMonth
    extends MonthAbstract
{
    public function __construct(int $year, int $month)
    {
        parent::__construct(mktime(0, 0, 0, $month, 1, $year));
    }
}