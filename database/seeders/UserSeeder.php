<?php

namespace Sajadsdi\Marketplace\Seeders;

use Illuminate\Database\Seeder;
use Sajadsdi\Marketplace\Model\User\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(10)->create();
    }
}
