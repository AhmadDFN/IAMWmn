<?php

namespace Database\Seeders;

use App\Models\Provinsi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class provinsisCSV extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('csv/provinsis.sql');
        $sql = file_get_contents($path);

        DB::unprepared($sql);
    }
    // public function run(): void
    // {
    //     $path = database_path('csv/provinsis.csv');
    //     $data = $this->csvToArray($path, ',');
    //     // dd($data);

    //     DB::table('provinsis')->insert($data);
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
