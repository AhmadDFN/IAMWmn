<?php

namespace App\Helpers;

use DateTime;
use DateTimeZone;

class getDateNow
{
    public static function getDateNow($format = 'm/d/Y')
    {
        $tz_object = new DateTimeZone('Asia/Jakarta');
        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        return $datetime->format($format);
    }
}
