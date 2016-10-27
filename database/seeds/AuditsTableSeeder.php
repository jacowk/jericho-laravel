<?php

use Illuminate\Database\Seeder;
use OwenIt\Auditing\Auditing;

class AuditsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Auditing::truncate();
    }
}
