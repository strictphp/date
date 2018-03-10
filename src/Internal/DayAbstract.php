<?php

namespace Strict\Date\Internal;

use Strict\Date\DayInterface;


/**
 * [(Virtually) Abstract Class] Day
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Strict PHP Project. All Rights Reserved.
 * @package strictphp/date
 * @since 1.0.0
 *
 * @internal
 */
class DayAbstract
    implements DayInterface
{
    private $time;
    private const DAY_COUNT = 86400;

    /**
     * DayAbstract constructor.
     *
     * @param int $time hour, minute and second must be zero.
     */
    protected function __construct(int $time)
    {
        $this->time = $time;
    }

    /**
     * Returns DayInterface of tomorrow.
     *
     * No boundary check (e.g. 2038)
     *
     * @return DayInterface
     */
    public function getNextDay(): DayInterface
    {
        return new self($this->time + self::DAY_COUNT);
    }

    /**
     * Returns DayInterface of yesterday.
     *
     * No boundary check (e.g. 1970)
     *
     * @return DayInterface
     */
    public function getLastDay(): DayInterface
    {
        return new self($this->time - self::DAY_COUNT);
    }

    /**
     * Returns n days after/before today.
     *
     * No boundary check (e.g. 2038)
     *
     * @param int $interval
     * @return DayInterface
     */
    public function getNDaysAfterToday(int $interval): DayInterface
    {
        return new self($this->time + self::DAY_COUNT * $interval);
    }

    /**
     * Returns day of the week.
     *
     * e.g. 2018-7-28 => 6 (Sat)
     *
     * @return int
     */
    public function getWeek(): int
    {
        return (int)date('w', $this->time);
    }

    /**
     * Returns day.
     *
     * e.g. 2018-7-28 => 28
     *
     * @return int
     */
    public function getDay(): int
    {
        return (int)date('j', $this->time);
    }

    /**
     * Returns month.
     *
     * e.g. 2018-07-28 => 7
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
     * e.g. 2018-07-28 => 2018
     *
     * @return int
     */
    public function getYear(): int
    {
        return (int)date('Y', $this->time);
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
     * @param string $format
     * @return string
     */
    public function format(string $format): string
    {
        return date($format, $this->time);
    }

    /**
     * Compare two days.
     *
     * -1 if $this < $comparison
     *  0 if $this = $comparison
     *  1 if $this > $comparison
     *
     * note
     *   Day(2013-03-04) < Day(2013-03-05)
     *
     * @param DayInterface $comparison
     * @return int
     */
    public function compare(DayInterface $comparison): int
    {
        return $this->time <=> $comparison->getTimeStamp();
    }
}