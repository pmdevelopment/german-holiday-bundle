<?php
/**
 * Created by PhpStorm.
 * User: sjoder
 * Date: 15.06.2017
 * Time: 15:28
 */

namespace PM\Bundle\GermanHolidayBundle\Component\Constants;


/**
 * Class States
 *
 * @package PM\Bundle\GermanHolidayBundle\Component\Constants
 */
class States
{
    /* ISO 3166-2 */
    const BADEN_WUERTTEMBERG = 'DE-BW';
    const BAVARIA = 'DE-BY';
    const BERLIN = 'DE-BE';
    const BRANDENBURG = 'DE-BB';
    const BREMEN = 'DE-HB';
    const HAMBURG = 'DE-HH';
    const HESSE = 'DE-HE';
    const MECKLENBURG_WESTERN_POMERANIA = 'DE-MV';
    const LOWER_SAXONY = 'DE-NI';
    const NORTHRHINE_WESTPHALIA = 'DE-NW';
    const RHINELAND_PALATINATE = 'DE-RP';
    const SAARLAND = 'DE-SL';
    const SAXONY = 'DE-SN';
    const SAXONY_ANHALT = 'DE-ST';
    const SCHLESWIG_HOLSTEIN = 'DE-SH';
    const THURINGIA = 'DE-TH';

    /**
     * Get All
     *
     * @return array
     */
    public static function getAll()
    {
        return [
            self::BADEN_WUERTTEMBERG            => self::BADEN_WUERTTEMBERG,
            self::BAVARIA                       => self::BAVARIA,
            self::BERLIN                        => self::BERLIN,
            self::BRANDENBURG                   => self::BRANDENBURG,
            self::BREMEN                        => self::BREMEN,
            self::HAMBURG                       => self::HAMBURG,
            self::HESSE                         => self::HESSE,
            self::MECKLENBURG_WESTERN_POMERANIA => self::MECKLENBURG_WESTERN_POMERANIA,
            self::LOWER_SAXONY                  => self::LOWER_SAXONY,
            self::NORTHRHINE_WESTPHALIA         => self::NORTHRHINE_WESTPHALIA,
            self::RHINELAND_PALATINATE          => self::RHINELAND_PALATINATE,
            self::SAARLAND                      => self::SAARLAND,
            self::SAXONY                        => self::SAXONY,
            self::SAXONY_ANHALT                 => self::SAXONY_ANHALT,
            self::SCHLESWIG_HOLSTEIN            => self::SCHLESWIG_HOLSTEIN,
            self::THURINGIA                     => self::THURINGIA,
        ];
    }

    /**
     * Number of States
     *
     * @return int
     */
    public static function getCount()
    {
        return 16;
    }
}