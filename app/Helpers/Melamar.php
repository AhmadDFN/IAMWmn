<?php

namespace App\Helpers;

use DateTime;
use DateTimeZone;

class Melamar
{
    public static function getActiveJob($tglstart, $tglend, $id, $userid)
    {
        $val = "";
        include 'lib/koneksi.php';
        $datenow  = new DateTime(getDateNow::getDateNow());
        $datestart  = new DateTime($tglstart);
        $dateend  = new DateTime($tglend);
        $diff   = $datestart->diff($datenow);

        $q = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE lowongan_id='$id' AND user_id='$userid'");
        $count = mysqli_num_rows($q);

        if ($count < 1) {
            if ($datestart > $datenow && $dateend >= $datenow) {
                if ($diff->d <= 10) {
                    $val = '<span class="label label-info">' . $diff->d . ' hari lagi pendaftaran Dibuka</span>';
                } else {
                    $val = '<span class="label label-info">Segera Dibuka</span>';
                }
            }

            if ($datestart <= $datenow && $dateend >= $datenow) {
                $val = '<a href="?page=lokeradd&id=' . $id . '" class="btn btn-primary btn-xs btn-block"><i class="fa fa-check-circle"></i> Pilih</a>';
            }
        } else {
            $val = '<span class="label label-success">Sedang Aktif <i class="fa fa-check"></i></span>';
        }

        return $val;
    }
}
