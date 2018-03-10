<?php

namespace Strict\Date\Years;

use Strict\Date\Internal\YearAbstract;


/**
 * [Class] Y Year
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Strict PHP Project. All Rights Reserved.
 * @package strictphp/date
 * @since 1.0.0
 */
class UnixTimeYear
    extends YearAbstract
{
    public function __construct(int $time)
    {
        parent::__construct(strtotime(date('Y-01-01', $time)));
    }
}