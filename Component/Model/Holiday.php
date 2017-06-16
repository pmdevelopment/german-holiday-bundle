<?php
/**
 * Created by PhpStorm.
 * User: sjoder
 * Date: 15.06.2017
 * Time: 16:44
 */

namespace PM\Bundle\GermanHolidayBundle\Component\Model;

use DateTime;


/**
 * Class Holiday
 *
 * @package PM\Bundle\GermanHolidayBundle\Component\Model
 */
class Holiday
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $states;

    /**
     * @var DateTime
     */
    private $day;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Holiday
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param DateTime $day
     *
     * @return Holiday
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * @return array
     */
    public function getStates()
    {
        return $this->states;
    }

    /**
     * @param array $states
     *
     * @return Holiday
     */
    public function setStates($states)
    {
        $this->states = $states;

        return $this;
    }

}