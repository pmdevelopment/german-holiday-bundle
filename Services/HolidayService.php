<?php
/**
 * Created by PhpStorm.
 * User: sjoder
 * Date: 15.06.2017
 * Time: 16:43
 */

namespace PM\Bundle\GermanHolidayBundle\Services;

use _PHPStan_ac6dae9b0\Symfony\Component\Console\Exception\LogicException;
use PM\Bundle\GermanHolidayBundle\Component\Constants\Holidays;
use PM\Bundle\GermanHolidayBundle\Component\Constants\Zips;
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
    public function getAll(int $year = null, string $state = null)
    {
        if (null === $year) {
            $year = date('Y');
        }

        $result = [];

        foreach (Holidays::getAll() as $holidayId) {
            $states = Holidays::getStates($holidayId, $year);

            if (null === $state || true === in_array($state, $states)) {
                $holiday = new Holiday();
                $holiday
                    ->setName($holidayId)
                    ->setDay(CalculationHelper::getByHoliday($holidayId, $year))
                    ->setStates($states);

                $result[] = $holiday;
            }
        }


        return $result;
    }

    public function getHoliday(\DateTimeImmutable $date, ?string $state = null, ?string $zip = null): ?string
    {
        if(null !== $zip){
            $state = Zips::getState($zip);
        }
        
        if(null === $state){
            throw new LogicException('Not a valid german state or zipcode');
        }

        foreach ($this->getAll($date->format('Y'), $state) as $holiday) {
            if(true === $holiday->isThisDate($date)){
                return $holiday->getName();
            }
        }

        return null;
    }

    public function isHoliday(\DateTimeImmutable $date, ?string $state = null, ?string $zip = null): bool
    {
        return $this->getHoliday($date, $state, $zip) !== null;
    }
}