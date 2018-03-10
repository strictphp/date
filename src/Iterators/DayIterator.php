<?php

namespace Strict\Date\Iterators;

use Iterator;
use Strict\Date\DayInterface;


/**
 * [Class] Day Iterator
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Strict PHP Project. All Rights Reserved.
 * @package strictphp/date
 * @since 1.0.0
 */
class DayIterator
    implements Iterator
{
    private $begin;
    private $end;
    private $current;

    public function __construct(
        DayInterface $begin,
        DayInterface $end
    ) {
        $this->begin = $begin;
        $this->end = $end;
        $this->current = $begin;
    }

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     *
     * @return DayInterface
     */
    public function current(): DayInterface
    {
        return $this->current;
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     *
     * @return void
     */
    public function next(): void
    {
        $this->current = $this->current->getNextDay();
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     *
     * @return int always zero
     */
    public function key(): int
    {
        return 0;
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     *
     * @return bool
     */
    public function valid(): bool
    {
        return $this->current->compare($this->end) === -1;
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     *
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->current = $this->begin;
    }
}