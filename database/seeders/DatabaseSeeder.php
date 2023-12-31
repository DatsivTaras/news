<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CreateRoles::class);
        $this->call(GenerateAdminAccounts::class);
        $this->call(GenerateSettings::class);
    }
}
