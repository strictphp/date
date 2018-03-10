# Date
Provides strong control of date, featuring really easy iteration.

# Installation
`composer install strictphp/date`

# Usage
## Day
### DayInterface
```php
namespace Strict\Date;

interface DayInterface
{
    public const WEEK_SUN = 0;
    public const WEEK_MON = 1;
    public const WEEK_TUE = 2;
    public const WEEK_WED = 3;
    public const WEEK_THU = 4;
    public const WEEK_FRI = 5;
    public const WEEK_SAT = 6;
    
    /**
     * Returns DayInterface of tomorrow.
     *
     * No boundary check (e.g. 2038)
     *
     * @return DayInterface
     */
    public function getNextDay(): DayInterface;

    /**
     * Returns DayInterface of yesterday.
     *
     * No boundary check (e.g. 1970)
     *
     * @return DayInterface
     */
    public function getLastDay(): DayInterface;

    /**
     * Returns n days after/before today.
     *
     * No boundary check (e.g. 2038)
     *
     * @param int $interval
     * @return DayInterface
     */
    public function getNDaysAfterToday(int $interval): DayInterface;

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
    public function compare(DayInterface $comparison): int;
    
    /**
     * Returns day.
     *
     * @return int
     */
    public function getDay(): int;

    /**
     * Returns day of the week.
     *
     * @return int
     */
    public function getWeek(): int;
    
    /**
     * Returns month.
     *
     * @return int
     */
    public function getMonth(): int;
    
    /**
     * Returns year.
     *
     * @return int
     */
    public function getYear(): int;
    
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
```

### Implementations
```php
namespace Strict\Date\Days;

class YMDDay
    implements DayInterface
{
    public function __construct(int $year, int $month, int $day);
}
new YMDDay(2018, 3, 4); // 2018-03-04

class UnixTimeDay
    implements DayInterface
{
    public function __construct(int $time);
}
new UnixTimeDay(time());    // today

class StringDay
    implements DayInterface
{
    public function __construct(string $time);
}
new StringDay('2018-03-04');
```

### Iteration
```php
use Strict\Date\Iterators\DayIterator;

$it = new DayIterator(
    new YMDDay(2018, 3, 1),
    new YMDDay(2018, 4, 1)
);
foreach ($it as $day) {
    /* DayInterface $day from 2018-03-01 to 2018-03-31 */
}
```

## Month
### MonthInterface
```php
namespace Strict\Date;

interface MonthInterface
    extends IteratorAggregate
{
    /**
     * Returns DayInterface points the first day of this month.
     *
     * @return DayInterface
     */
    public function getFirstDay(): DayInterface;

    /**
     * Returns DayInterface points the last day of this month.
     *
     * @return DayInterface
     */
    public function getLastDay(): DayInterface;

    /**
     * Get n-th day.
     *
     * The value of $day must be STRICTLY plus or minus. Zero is not allowed.
     *
     * Suppose $this points 2018-03.
     * The return value of $this->getNthDay(  3) points 2018-03-03.
     * The return value of $this->getNthDay( 31) points 2018-03-31.
     * The return value of $this->getNthDay( 32) points 2018-04-01.
     * The return value of $this->getNthDay( -3) points 2018-03-29 ( 3 days before 2018-04-01).
     * The return value of $this->getNthDay(-31) points 2018-03-01 (31 days before 2018-04-01).
     * The return value of $this->getNthDay(-32) points 2018-02-28 (32 days before 2018-04-01).
     *
     * @param int $day
     * @return DayInterface
     */
    public function getNthDay(int $day): DayInterface;

    /**
     * Returns MonthInterface of the next month.
     *
     * @return MonthInterface
     */
    public function getNextMonth(): MonthInterface;

    /**
     * Returns MonthInterface of the last month.
     *
     * @return MonthInterface
     */
    public function getLastMonth(): MonthInterface;

    /**
     * Returns n months after/before this month.
     *
     * @param int $interval
     * @return MonthInterface
     */
    public function getNMonthsAfter(int $interval): MonthInterface;

    /**
     * Returns DayIterator from the first day to the last day of this month.
     *
     * @return DayIterator
     */
    public function getIterator(): DayIterator;

    /**
     * Compare two months.
     *
     * -1 if $this < $comparison
     *  0 if $this = $comparison
     *  1 if $this > $comparison
     *
     * note
     *   Month(2013-03) < Month(2013-04)
     *
     * @param MonthInterface $comparison
     * @return int
     */
    public function compare(MonthInterface $comparison): int;
    
    /**
     * Returns month.
     *
     * @return int
     */
    public function getMonth(): int;
    
    /**
     * Returns year.
     *
     * @return int
     */
    public function getYear(): int;
    
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
```

### Implementations
```php
namespace Strict\Date\Months;

class YMMonth
    implements MonthInterface
{
    public function __construct(int $year, int $month);
}
new YMMonth(2018, 3); // 2018-03

class UnixTime
    implements MonthInterface
{
    public function __construct(int $time);
}
new UnixTimeMonth(time());    // this month

class DayMonth
    implements MonthInterface
{
    public function __construct(DayInterface $day);
}
new DayMonth(new YMDDay(2018, 3, 4));   // 2018-03
```

### Iterations
```php
foreach ((new YMMonth(2018, 3)) as $day) {
    /* DayInterface $day from 2018-03-01 to 2018-03-31 */
}
```

```php
use Strict\Date\Iterators\MonthIterator;

$it = new MonthIterator(
    new YMMonth(2018, 1),
    new YMMonth(2019, 1)
);
foreach ($it as $month) {
    /* MonthInterface $month from 2018-01 to 2018-12 */
}
```

## Year
### YearInterface
```php
namespace Strict\Date;

interface YearInterface
    extends IteratorAggregate
{
    /**
     * Returns DayInterface points the first day of this year.
     *
     * @return DayInterface
     */
    public function getFirstDay(): DayInterface;

    /**
     * Returns DayInterface points the last day of this year.
     *
     * @return DayInterface
     */
    public function getLastDay(): DayInterface;

    /**
     * Returns DayInterface points the n-th day of this year.
     *
     * The value of $day must be STRICTLY plus or minus. Zero is not allowed.
     *
     * Suppose $this points 2018.
     * The return value of $this->getNthDay(   1) points 2018-01-01.
     * The return value of $this->getNthDay( 365) points 2018-12-31.
     * The return value of $this->getNthDay( 366) points 2019-01-01.
     * The return value of $this->getNthDay(  -1) points 2018-12-31.
     * The return value of $this->getNthDay(-365) points 2018-01-01.
     * The return value of $this->getNthDay(-366) points 2017-12-31.
     *
     * @param int $day
     * @return DayInterface
     */
    public function getNthDay(int $day): DayInterface;

    /**
     * Returns MonthInterface points the first month of this year.
     *
     * @return MonthInterface
     */
    public function getFirstMonth(): MonthInterface;

    /**
     * Returns MonthInterface points the last month of this year.
     *
     * @return MonthInterface
     */
    public function getLastMonth(): MonthInterface;

    /**
     * Returns MonthInterface points the n-th month of this year.
     *
     * The value of $month must be STRICTLY plus or minus. Zero is not allowed.
     *
     * Suppose $this points 2018.
     * The return value of $this->getNthMonth(  1) points 2018-01.
     * The return value of $this->getNthMonth( 12) points 2018-12.
     * The return value of $this->getNthMonth( 13) points 2019-01.
     * The return value of $this->getNthMonth( -1) points 2018-12.
     * The return value of $this->getNthMonth(-12) points 2018-01.
     * The return value of $this->getNthMonth(-13) points 2017-12.
     *
     * @param int $month
     * @return MonthInterface
     */
    public function getNthMonth(int $month): MonthInterface;

    /**
     * Returns YearInterface of the next year.
     *
     * @return YearInterface
     */
    public function getNextYear(): YearInterface;

    /**
     * Returns YearInterface of the last year.
     *
     * @return YearInterface
     */
    public function getLastYear(): YearInterface;

    /**
     * Returns n years after/before this year.
     *
     * @param int $interval
     * @return YearInterface
     */
    public function getNYearsAfter(int $interval): YearInterface;

    /**
     * Returns MonthIterator from the first month to the last month of this year.
     *
     * Behave the same way as getIterator();
     *
     * @return MonthIterator
     */
    public function getMonthIterator(): MonthIterator;

    /**
     * Returns DayIterator from the first day to the last day of this year.
     *
     * @return DayIterator
     */
    public function getDayIterator(): DayIterator;

    /**
     * Compare two years.
     *
     * -1 if $this < $comparison
     *  0 if $this = $comparison
     *  1 if $this > $comparison
     *
     * note
     *   Year(2012) < Year(2013)
     *
     * @param YearInterface $comparison
     * @return int
     */
    public function compare(YearInterface $comparison): int;
    
    /**
     * Returns year.
     *
     * @return int
     */
    public function getYear(): int;
    
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
```

### Implementation
```php
namespace Strict\Date\Years;

class YYear
    implements YearInterface
{
    public function __construct(int $year) { /* ... */ }
}
new YYear(2018);

class UnixTimeYear
    implements YearInterface
{
    public function __construct(int $time) { /* ... */ }
}
new UnixTimeYear(time());   // this year

class MonthYear
    implements YearInterface
{
    public function __construct(MonthInterface $month) { /* ... */ }
}
new MonthYear(new YMMonth(2018, 3));    // 2018

class DayYear
    implements YearInterface
{
    public function __construct(DayInterface $day) { /* ... */ }
}
new DayYear(new YMDDay(2018, 3, 4));    // 2018
```

### Iterations
```php
foreach ((new YYear(2018)) as $month) {
    /* MonthInterface $month from 2018-01 to 2018-12 */
}

foreach ((new YYear(2018))->getMonthIterator() as $month) {
    /* MonthInterface $month from 2018-01 to 2018-12 */
}

foreach ((new YYear(2018))->getDayIterator() as $day) {
    /* DayInterface $day from 2018-01-01 to 2018-12-31 */
}
```

```php
use Strict\Date\Iterators\YearIterator;

$it = new YearIterator(
    new YYear(2011),
    new YYear(2021)
);
foreach ($it as $year) {
    /* YearInterface $year from 2011 to 2020 */
}
```