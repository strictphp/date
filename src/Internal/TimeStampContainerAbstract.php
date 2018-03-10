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
    implements TimeStampContainerInterfaceYMD
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

    /**
     * Returns year.
     *
     * @return int
     */
    public function getYear(): int
    {
        return (int)date('Y', $this->time);
    }

    /**
     * Returns month.
     *
     * @return int
     */
    public function getMonth(): int
    {
        return (int)date('n', $this->time);
    }

    /**
     * Returns day.
     *
     * @return int
     */
    public function getDay(): int
    {
        return (int)date('j', $this->time);
    }

    /**
     * Returns day of the week.
     *
     * @return int
     */
    public function getWeek(): int
    {
        return (int)date('w', $this->time);
    }
}