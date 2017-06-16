<?php
/**
 * Created by PhpStorm.
 * User: sjoder
 * Date: 15.06.2017
 * Time: 16:43
 */

namespace PM\Bundle\GermanHolidayBundle\Services;

use PM\Bundle\GermanHolidayBundle\Component\Constants\Holidays;
use PM\Bundle\GermanHolidayBundle\Component\Helper\CalculationHelper;
use PM\Bundle\GermanHolidayBundle\Component\Model\Holiday;


/**
 * Class HolidayService
 *
 * @package PM\Bundle\GermanHolidayBundle\Services
 */
class HolidayService
{
    /**
     * Get all
     *
     * @param null|integer $year
     *
     * @return array|\PM\Bundle\GermanHolidayBundle\Component\Model\Holiday[]
     */
    public function getAll($year = null)
    {
        if (null === $year) {
            $year = date('Y');
        }

        $result = [];

        foreach (Holidays::getAll() as $holidayId) {
            $holiday = new Holiday();
            $holiday
                ->setName($holidayId)
                ->setDay(CalculationHelper::getByHoliday($holidayId, $year))
                ->setStates(Holidays::getStates($holidayId, $year));

            $result[] = $holiday;
        }


        return $result;
    }
}