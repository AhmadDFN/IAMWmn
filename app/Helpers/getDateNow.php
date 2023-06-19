<?php

namespace App\Helpers;

use DateTime;
use DateTimeZone;

class getDateNow
{
    public static function getDateNow()
    {
        $tz_object = new DateTimeZone('Asia/Jakarta');
        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        return $datetime->format('m/d/Y');
    }
}
