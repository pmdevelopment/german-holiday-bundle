<?php
/**
 * Created by PhpStorm.
 * User: sjoder
 * Date: 19.06.2017
 * Time: 10:05
 */

namespace PM\Bundle\GermanHolidayBundle\Twig;

use PM\Bundle\GermanHolidayBundle\Component\Constants\Holidays;
use PM\Bundle\GermanHolidayBundle\Component\Constants\States;


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
}