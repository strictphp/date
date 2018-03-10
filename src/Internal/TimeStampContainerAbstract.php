<?php

namespace Strict\Date\Internal;


/**
 * [Abstract Class] TimeStamp Container
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Strict PHP Project. All Rights Reserved.
 * @package strictphp/date
 * @since 1.0.0
 *
 * @internal
 */
abstract class TimeStampContainerAbstract
    implements TimeStampContainerInterface
{
    protected $time;

    protected function __construct(int $time)
    {
        $this->time = $time;
    }

    /**
     * Returns UNIX timestamp.
     *
     * Hour, minute and second of the return value must be zero.
     *
     * @return int
     */
    public function getTimeStamp(): int
    {
        return $this->time;
    }

    /**
     * Format timestamp.
     *
     * @param string $format
     * @return string
     */
    public function format(string $format): string
    {
        return date($format, $this->time);
    }
}