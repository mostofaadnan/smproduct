<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class email_sms_template extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      
        $sql = file_get_contents(database_path() . '/seeders/email_sms_templates.sql');
        DB::unprepared($sql);
        
    }
}
