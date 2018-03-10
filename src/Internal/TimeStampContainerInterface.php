<?php

namespace Strict\Date\Internal;


/**
 * [Interface] TimeStamp Container Interface
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Strict PHP Project. All Rights Reserved.
 * @package strictphp/date
 * @since 1.0.0
 *
 * @internal
 */
interface TimeStampContainerInterface
{
    /**
     * Returns UNIX timestamp.
     *
     * Hour, minute and second of the return value must be zero.
     *
     * @return int
     */
    public function getTimeStamp(): int;

    /**
     * Format timestamp.
     *
     * @param string $format
     * @return string
     */
    public function format(string $format): string;
}