<?php
/**
 * Created by PhpStorm.
 * User: sjoder
 * Date: 15.06.2017
 * Time: 16:17
 */

namespace PM\Bundle\GermanHolidayBundle\Component\Helper;

use DateInterval;
use DateTime;
use PM\Bundle\GermanHolidayBundle\Component\Constants\Holidays;


/**
 * Class CalculationHelper
 *
 * @package PM\Bundle\GermanHolidayBundle\Component\Helper
 */
class CalculationHelper
{
    /**
     * Get New Year
     *
     * @param int|null $year
     *
     * @return DateTime
     */
    public static function getDateNewYear($year = null)
    {
        $year = self::getValidYear($year);

        return new DateTime(sprintf('%s-01-01', $year));
    }

    /**
     * Get Epiphany
     *
     * @param int|null $year
     *
     * @return DateTime
     */
    public static function getDateEpiphany($year = null)
    {
        $year = self::getValidYear($year);

        return new DateTime(sprintf('%s-01-06', $year));
    }

    /**
     * Get Good Friday
     *
     * @param int|null $year
     *
     * @return DateTime
     */
    public static function getDateGoodFriday($year = null)
    {
        $easter = self::getDateEasterSunday($year);

        return $easter->sub(new DateInterval('P2D'));
    }

    /**
     * Get Easter
     *
     * @param int|null $year
     *
     * @return DateTime
     */
    public static function getDateEasterSunday($year = null)
    {
        $year = self::getValidYear($year);
        $date = new DateTime(sprintf('%s-03-21', $year));

        return $date->add(new DateInterval(sprintf('P%sD', easter_days($year))));
    }

    /**
     * Get Easter
     *
     * @param int|null $year
     *
     * @return DateTime
     */
    public static function getDateEasterMonday($year = null)
    {
        $easter = self::getDateEasterSunday($year);

        return $easter->add(new DateInterval('P1D'));
    }

    /**
     * Get Labour Day
     *
     * @param int|null $year
     *
     * @return DateTime
     */
    public static function getDateLabourDay($year = null)
    {
        $year = self::getValidYear($year);

        return new DateTime(sprintf('%s-05-01', $year));
    }

    /**
     * Get Easter
     *
     * @param int|null $year
     *
     * @return DateTime
     */
    public static function getDateAscensionDay($year = null)
    {
        $easter = self::getDateEasterSunday($year);

        return $easter->add(new DateInterval('P39D'));
    }

    /**
     * Get Easter
     *
     * @param int|null $year
     *
     * @return DateTime
     */
    public static function getDatePentecost($year = null)
    {
        $easter = self::getDateEasterSunday($year);

        return $easter->add(new DateInterval('P49D'));
    }

    /**
     * Get Easter
     *
     * @param int|null $year
     *
     * @return DateTime
     */
    public static function getDatePentecostMonday($year = null)
    {
        $easter = self::getDatePentecost($year);

        return $easter->add(new DateInterval('P1D'));
    }

    /**
     * Get Easter
     *
     * @param int|null $year
     *
     * @return DateTime
     */
    public static function getDateCorpusChristi($year = null)
    {
        $easter = self::getDateEasterSunday($year);

        return $easter->add(new DateInterval('P60D'));
    }

    /**
     * Get Assumption Day
     *
     * @param int|null $year
     *
     * @return DateTime
     */
    public static function getDateAssumptionDay($year = null)
    {
        $year = self::getValidYear($year);

        return new DateTime(sprintf('%s-08-15', $year));
    }

    /**
     * Get Day of German Unity
     *
     * @param int|null $year
     *
     * @return DateTime
     */
    public static function getDateDayOfGermanUnity($year = null)
    {
        $year = self::getValidYear($year);

        return new DateTime(sprintf('%s-10-03', $year));
    }

    /**
     * Get Reformation day
     *
     * @param int|null $year
     *
     * @return DateTime
     */
    public static function getDateReformationDay($year = null)
    {
        $year = self::getValidYear($year);

        return new DateTime(sprintf('%s-10-31', $year));
    }

    /**
     * Get All Hollow
     *
     * @param int|null $year
     *
     * @return DateTime
     */
    public static function getDateAllHollows($year = null)
    {
        $year = self::getValidYear($year);

        return new DateTime(sprintf('%s-11-01', $year));
    }

    /**
     * Get day of Repentance
     *
     * @param int|null $year
     *
     * @return DateTime
     */
    public static function getDateDayOfRepentance($year = null)
    {
        $year = self::getValidYear($year);
        $date = strtotime('last Wednesday', mktime(0, 0, 0, 11, 23, $year));

        return (new DateTime())->setTimestamp($date);
    }

    /**
     * Get Christmas
     *
     * @param int|null $year
     *
     * @return DateTime
     */
    public static function getDateChristmasDay($year = null)
    {
        $year = self::getValidYear($year);

        return new DateTime(sprintf('%s-12-25', $year));
    }

    /**
     * Get Day after Christmas
     *
     * @param int|null $year
     *
     * @return DateTime
     */
    public static function getDateDayAfterChristmas($year = null)
    {
        $year = self::getValidYear($year);

        return new DateTime(sprintf('%s-12-26', $year));
    }

    /**
     * Get Valid Year
     *
     * @param int|null $year
     *
     * @return int
     */
    public static function getValidYear($year = null)
    {
        if (false === is_numeric($year)) {
            return date('Y');
        }

        return $year;
    }

    /**
     * Get By Type
     *
     * @param string   $holiday
     * @param int|null $year
     *
     * @return DateTime
     */
    public static function getByHoliday($holiday, $year = null)
    {
        $relation = [
            Holidays::NEW_YEAR            => 'getDateNewYear',
            Holidays::EPIPHANY            => 'getDateEpiphany',
            Holidays::GOOD_FRIDAY         => 'getDateGoodFriday',
            Holidays::EASTER_SUNDAY       => 'getDateEasterSunday',
            Holidays::EASTER_MONDAY       => 'getDateEasterMonday',
            Holidays::LABOR_DAY           => 'getDateLabourDay',
            Holidays::ASCENSION_DAY       => 'getDateAscensionDay',
            Holidays::PENTECOST           => 'getDatePentecost',
            Holidays::PENTECOST_MONDAY    => 'getDatePentecostMonday',
            Holidays::CORPUS_CHRISTI      => 'getDateCorpusChristi',
            Holidays::ASSUMPTION_DAY      => 'getDateAssumptionDay',
            Holidays::DAY_OF_GERMAN_UNITY => 'getDateDayOfGermanUnity',
            Holidays::REFORMATION_DAY     => 'getDateReformationDay',
            Holidays::ALL_HALLOWS         => 'getDateAllHollows',
            Holidays::DAY_OF_REPENTANCE   => 'getDateDayOfRepentance',
            Holidays::CHRISTMAS_DAY       => 'getDateChristmasDay',
            Holidays::DAY_AFTER_CHRISTMAS => 'getDateDayAfterChristmas',
        ];

        if (false === is_string($holiday) || false === isset($relation[$holiday])) {
            throw new \LogicException(sprintf('Unknown holiday %s', $holiday));
        }

        $method = $relation[$holiday];

        return self::$method($year);
    }

    /**
     * Is Holiday
     *
     * @param DateTime $day
     * @param string   $state
     *
     * @return bool
     */
    public static function isHoliday(DateTime $day, $state)
    {
        foreach (Holidays::getByState($state, $day->format('Y')) as $holidayName) {
            if (self::getByHoliday($holidayName, $day->format('Y'))->format('Y-m-d') === $day->format('Y-m-d')) {
                return true;
            }
        }

        return false;
    }
}