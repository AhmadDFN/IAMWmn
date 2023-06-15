<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class kecamatansCSV extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        $path = database_path('csv/kecamatans.sql');
        $sql = file_get_contents($path);

        DB::unprepared($sql);
    }
    // public function run(): void
    // {
    //     $path = database_path('csv/kecamatans.csv');
    //     $data = $this->csvToArray($path, ',');

    //     DB::table('kecamatans')->insert($data);
    // }

    // private function csvToArray($filename = '', $delimiter = ',')
    // {
    //     if (!file_exists($filename) || !is_readable($filename)) {
    //         return false;
    //     }

    //     $header = null;
    //     $data = [];

    //     if (($handle = fopen($filename, 'r')) !== false) {
    //         while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
    //             if (!$header) {
    //                 $header = $row;
    //             } else {
    //                 $data[] = array_combine($header, $row);
    //             }
    //         }
    //         fclose($handle);
    //     }

    //     return $data;
    // }
}
