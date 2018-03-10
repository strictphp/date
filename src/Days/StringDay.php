<?php

namespace Strict\Date\Days;

use Strict\Date\Internal\DayAbstract;


/**
 * [Class] String Day
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Strict PHP Project. All Rights Reserved.
 * @package strictphp/date
 * @since 1.0.0
 */
class StringDay
    extends DayAbstract
{
    /**
     * StringDay constructor.
     *
     * @param string $time like 2018-03-04
     */
    public function __construct(string $time)
    {
        parent::__construct(strtotime('today', strtotime($time)));
    }
}