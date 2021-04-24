<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class missionSeeder extends Seeder
{
    function randomDate($start_date, $end_date)
    {
        // Convert to timetamps
        $min = strtotime($start_date);
        $max = strtotime($end_date);

        // Generate random number using above bounds
        $val = rand($min, $max);

        // Convert back to desired date format
        return date('Y-m-d H:i:s', $val);
    }

    function randomdistirct($number)
    {
        $distirct = array('Islands','Kwai Tsing', 'North', 'Sai Kung', 'Sha Tin', 'Tai Po', 'Tsuen Wan',
        'Tuen Mun', 'Yuen Long', 'Kowloon City', 'Kwun Tong', 'Sham Shui Po', 'Wong Tai Sin', 'Yau Tsim Mong',
        'Central and Western', 'Eastern', 'Southern', 'Wan Chai');

        return $distirct[$number];
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $record_number = 50;
        
        for($i = 0; $i < $record_number; $i++) {
            $record[] = [
                'MNAME' => 'random'.$i,
                'MCreator' => round(rand(1,2)),
                'MCreateTime' => $this->randomDate('01-01-2021', '30-04-2021'),
                'CenterLat' =>'22.'.rand(200000,500000),
                'CenterLng' =>'114.'.rand(0,350000),
                'MLocationName' => $this->randomdistirct(rand(0,17)),
                'MRange' => rand(8,200),
            ];
        }
        print_r($record);
        DB::table('Mission')->insert($record);
    }
}
