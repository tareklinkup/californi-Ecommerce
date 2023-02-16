<?php

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::create([
            'logo' => '', 
            'shop_name' => 'FK', 
            'address' => 'Mirpur', 
            'phone_1' => 00000000000, 
            'phone_2' => '', 
            'email_1' => 'admin@fk.com', 
            'email_2' => '', 
            'facebook' => '', 
            'twitter' => '', 
            'youtube' => '', 
            'vimeo' => ''
        ]);
    }
}
