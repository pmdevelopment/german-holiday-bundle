<?php
/**
 * Created by PhpStorm.
 * User: sjoder
 * Date: 15.06.2017
 * Time: 16:09
 */

namespace PM\Bundle\GermanHolidayBundle\Component\Constants;


/**
 * Class Holidays
 *
 * @package PM\Bundle\GermanHolidayBundle\Component\Constants
 */
class Holidays
{
    const NEW_YEAR = 'new_year';
    const EPIPHANY = 'epiphany';
    const GOOD_FRIDAY = 'good_friday';
    const EASTER_SUNDAY = 'easter_sunday';
    const EASTER_MONDAY = 'easter_monday';
    const LABOR_DAY = 'labor_day';
    const ASCENSION_DAY = 'ascension_day';
    const PENTECOST = 'pentecost';
    const PENTECOST_MONDAY = 'pentecost_monday';
    const CORPUS_CHRISTI = 'corpus_christi';
    const ASSUMPTION_DAY = 'assumption_day';
    const DAY_OF_GERMAN_UNITY = 'day_of_german_unity';
    const REFORMATION_DAY = 'reformation_day';
    const ALL_HALLOWS = 'all_hallows';
    const DAY_OF_REPENTANCE = 'day_of_repentance';
    const CHRISTMAS_DAY = 'christmas_day';
    const DAY_AFTER_CHRISTMAS = 'day_after_christmas';

    /**
     * Get All
     *
     * @return array
     */
    public static function getAll()
    {
        return [
            self::NEW_YEAR            => self::NEW_YEAR,
            self::EPIPHANY            => self::EPIPHANY,
            self::GOOD_FRIDAY         => self::GOOD_FRIDAY,
            self::EASTER_SUNDAY       => self::EASTER_SUNDAY,
            self::EASTER_MONDAY       => self::EASTER_MONDAY,
            self::LABOR_DAY           => self::LABOR_DAY,
            self::ASCENSION_DAY       => self::ASCENSION_DAY,
            self::PENTECOST           => self::PENTECOST,
            self::PENTECOST_MONDAY    => self::PENTECOST_MONDAY,
            self::CORPUS_CHRISTI      => self::CORPUS_CHRISTI,
            self::ASSUMPTION_DAY      => self::ASSUMPTION_DAY,
            self::DAY_OF_GERMAN_UNITY => self::DAY_OF_GERMAN_UNITY,
            self::REFORMATION_DAY     => self::REFORMATION_DAY,
            self::ALL_HALLOWS         => self::ALL_HALLOWS,
            self::DAY_OF_REPENTANCE   => self::DAY_OF_REPENTANCE,
            self::CHRISTMAS_DAY       => self::CHRISTMAS_DAY,
            self::DAY_AFTER_CHRISTMAS => self::DAY_AFTER_CHRISTMAS,
        ];
    }

    /**
     * Get By State
     *
     * Warning: Assumption day is city based in BY and not included.
     *          Corpus christi is city based in SN and TH and not included
     *
     * @param string   $state
     * @param int|null $year
     *
     * @return array
     */
    public static function getByState($state, $year = null)
    {
        $holidays = self::getCountrywide($year);

        /* BY and BW are the same */
        if (States::BAVARIA === $state || States::BADEN_WUERTTEMBERG === $state) {
            return array_merge($holidays, [
                self::EPIPHANY,
                self::CORPUS_CHRISTI,
                self::ALL_HALLOWS,
            ]);
        }

        /* BB, MV and TH are the same */
        if (2017 !== $year && true === in_array($state, [
                States::BRANDENBURG,
                States::MECKLENBURG_WESTERN_POMERANIA,
                States::THURINGIA,
            ])
        ) {
            return array_merge($holidays, [
                self::REFORMATION_DAY,
            ]);
        }

        /* HE only got one extra */
        if (States::HESSE === $state) {
            return array_merge($holidays, [
                self::CORPUS_CHRISTI,
            ]);
        }

        /* NW and RP are the same */
        if (States::NORTHRHINE_WESTPHALIA === $state || States::RHINELAND_PALATINATE === $state) {
            return array_merge($holidays, [
                self::CORPUS_CHRISTI,
                self::ALL_HALLOWS,
            ]);
        }

        /* SL got 3 extra */
        if (States::SAARLAND === $state) {
            return array_merge($holidays, [
                self::CORPUS_CHRISTI,
                self::ALL_HALLOWS,
                self::ASSUMPTION_DAY,
            ]);
        }

        /* SN got 2 extra */
        if (States::SAXONY === $state) {
            return array_unique(array_merge($holidays, [
                self::REFORMATION_DAY,
                self::DAY_OF_REPENTANCE,
            ]));
        }

        /* ST got 2 extra */
        if (States::SAXONY_ANHALT === $state) {
            return array_unique(array_merge($holidays, [
                self::EPIPHANY,
                self::REFORMATION_DAY,
            ]));
        }


        return $holidays;
    }

    /**
     * Get Country wide holidays
     *
     * @param int|null $year
     *
     * @return array
     */
    public static function getCountryWide($year = null)
    {
        $holidays = [
            self::NEW_YEAR,
            self::GOOD_FRIDAY,
            self::EASTER_SUNDAY,
            self::EASTER_MONDAY,
            self::LABOR_DAY,
            self::ASCENSION_DAY,
            self::PENTECOST,
            self::PENTECOST_MONDAY,
            self::DAY_OF_GERMAN_UNITY,
            self::CHRISTMAS_DAY,
            self::DAY_AFTER_CHRISTMAS,
        ];

        /* Sonderfall: 2017 ist Reformationstag bundesweit */
        if (2017 === $year) {
            $holidays[] = self::REFORMATION_DAY;
        }

        return $holidays;
    }

    /**
     * Get States for Holiday
     *
     * Warning: Corpus christi is city based in SN and TH and ignored
     *          Assumption day is city based in BY and ignored
     *
     * @param string   $holiday
     * @param int|null $year
     *
     * @return array
     */
    public static function getStates($holiday, $year = null)
    {
        if (true === in_array($holiday, self::getCountryWide($year))) {
            return States::getAll();
        }

        if (self::EPIPHANY === $holiday) {
            return [
                States::BADEN_WUERTTEMBERG,
                States::BAVARIA,
                States::SAXONY_ANHALT,
            ];
        }

        if (self::CORPUS_CHRISTI === $holiday) {
            return [
                States::BADEN_WUERTTEMBERG,
                States::BAVARIA,
                States::HESSE,
                States::NORTHRHINE_WESTPHALIA,
                States::RHINELAND_PALATINATE,
                States::SAARLAND,
            ];
        }

        if (self::ASSUMPTION_DAY === $holiday) {
            return [
                States::SAARLAND,
            ];
        }

        if (self::REFORMATION_DAY === $holiday) {
            return [
                States::BRANDENBURG,
                States::MECKLENBURG_WESTERN_POMERANIA,
                States::SAXONY,
                States::SAXONY_ANHALT,
                States::THURINGIA,
            ];
        }

        if (self::ALL_HALLOWS === $holiday) {
            return [
                States::BADEN_WUERTTEMBERG,
                States::BAVARIA,
                States::NORTHRHINE_WESTPHALIA,
                States::RHINELAND_PALATINATE,
                States::SAARLAND,
            ];
        }

        if (self::DAY_OF_REPENTANCE === $holiday) {
            return [
                States::SAXONY,
            ];
        }

        throw new \LogicException(sprintf('Unknown holiday %s', $holiday));
    }
}