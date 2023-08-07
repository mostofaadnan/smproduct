<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call(CreateAdminUserSeeder::class);
       $this->call(email_sms_template::class);
       $this->call(extention::class);
       $this->call(frontend::class);
       $this->call(gateway::class);
       $this->call(generalsetting::class);
       $this->call(language::class);
       $this->call(page::class);
       $this->call(user::class);
       $this->call(userextra::class);

    }
}
