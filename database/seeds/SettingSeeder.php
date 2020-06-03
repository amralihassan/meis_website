<?php

use Illuminate\Database\Seeder;
use App\Model\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'siteNameArabic' => 'مدارس ميدل ايست',
            'siteNameEnglish' => 'Middle East International Schools',
            'email' => 'admin@domain.com',
            'user_id' => 1,
            'address' => 'The ring, the intersection of Saft exit road, Mariouteya road',
            'contact' => '0100050703 - 0237983335',
            'openTime' => '9:00:00',
            'closeTime' => '14:00:00',
            'facebook' => 'https://www.facebook.com/MiddleEastInternationalSchools/',
            'youtube'   => 'https://www.facebook.com/MiddleEastInternationalSchools/'
        ]);
    }
}
