<?php
/**
 * Created by PhpStorm.
 * User: sjoder
 * Date: 19.06.2017
 * Time: 10:05
 */

namespace PM\Bundle\GermanHolidayBundle\Twig;

use DateTime;
use PM\Bundle\GermanHolidayBundle\Component\Constants\Holidays;
use PM\Bundle\GermanHolidayBundle\Component\Constants\States;
use PM\Bundle\GermanHolidayBundle\Component\Helper\CalculationHelper;
use PM\Bundle\GermanHolidayBundle\Component\Model\Holiday;


/**
 * Class HolidayTwigExtension
 *
 * @package PM\Bundle\GermanHolidayBundle\Twig
 */
class HolidayTwigExtension extends \Twig_Extension
{
    /**
     * Get Filters
     *
     * @return array
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter(
                'pm_holiday_get_states',
                [
                    $this,
                    'getStates',
                ]
            ),
            new \Twig_SimpleFilter(
                'pm_holiday_is_countrywide',
                [
                    $this,
                    'isCountryWide',
                ]
            ),
        ];
    }

    /**
     * Get Functions
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'pm_holiday_by_range',
                [
                    $this,
                    'getHolidaysByRange',
                ]
            ),
        ];
    }

    /**
     * Get States
     *
     * @param string   $holiday
     * @param int|null $year
     *
     * @return array
     */
    public function getStates($holiday, $year = null)
    {
        return Holidays::getStates($holiday, $year);
    }

    /**
     * Is CountryWide
     *
     * @param string   $holiday
     * @param int|null $year
     *
     * @return bool
     */
    public function isCountryWide($holiday, $year = null)
    {
        return (States::getCount() === count($this->getStates($holiday, $year)));
    }

    /**
     * Get Holidays by Range
     *
     * @param string        $state
     * @param DateTime      $from
     * @param DateTime|null $until
     * @param bool          $excludeHolidays
     *
     * @return array|\PM\Bundle\GermanHolidayBundle\Component\Model\Holiday[]
     */
    public function getHolidaysByRange($state, DateTime $from, $until = null, $excludeHolidays = false)
    {
        if (null === $until) {
            $until = new \DateTime();
        }

        if ($from > $until) {
            throw new \LogicException('From cannot be later than until');
        }

        $holidays = [];

        for ($year = $from->format('Y'); $year <= $until->format('Y'); $year++) {
            foreach (Holidays::getByState($state, $year) as $holiday) {
                $date = CalculationHelper::getByHoliday($holiday, $year);

                if ($date < $from || $date > $until) {
                    continue;
                }

                if(true === $excludeHolidays && 5 < $date->format('N')){
                    continue;
                }


                $holidayObject = new Holiday();
                $holidayObject
                    ->setDay($date)
                    ->setName($holiday);

                $holidays[] = $holidayObject;
            }
        }

        return $holidays;
    }
}