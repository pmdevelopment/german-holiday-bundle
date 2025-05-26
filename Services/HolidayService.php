<?php

namespace PM\Bundle\GermanHolidayBundle\Services;

use PM\Bundle\GermanHolidayBundle\Component\Constants\Holidays;
use PM\Bundle\GermanHolidayBundle\Component\Constants\Zips;
use PM\Bundle\GermanHolidayBundle\Component\Helper\CalculationHelper;
use PM\Bundle\GermanHolidayBundle\Component\Model\Holiday;

class HolidayService
{
    /**
     * @return array|\PM\Bundle\GermanHolidayBundle\Component\Model\Holiday[]
     */
    public function getAll(?int $year = null, ?string $state = null): array
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

    public function getHoliday(\DateTimeImmutable $date, string $state): ?string
    {
        foreach ($this->getAll($date->format('Y'), $state) as $holiday) {
            if(true === $holiday->isThisDate($date)){
                return $holiday->getName();
            }
        }

        return null;
    }

    public function isHoliday(\DateTimeImmutable $date, string $state): bool
    {
        return $this->getHoliday($date, $state) !== null;
    }
    
    public function getHolidayByZip(\DateTimeImmutable $date, string $zip): ?string
    {
        $state = Zips::getState($zip);

        if(null === $state){
            throw new \LogicException('Not a valid german state or zipcode');
        }
        
        return $this->getHoliday($date, $state);
    }

    public function isHolidayByZip(\DateTimeImmutable $date, string $zip): bool
    {
        return $this->getHolidayByZip($date, $zip) !== null;
    }
}