<?php

namespace Strict\Date\Internal;


/**
 * [Interface] TimeStamp Container Interface with getYear
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Strict PHP Project. All Rights Reserved.
 * @package strictphp/date
 * @since 1.0.0
 *
 * @internal
 */
interface TimeStampContainerInterfaceY
    extends TimeStampContainerInterface
{
    /**
     * Returns year.
     *
     * @return int
     */
    public function getYear(): int;
}