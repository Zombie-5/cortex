<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* // Verifica qual banco de dados está sendo utilizado
        if (DB::getDriverName() == 'mysql') {
            // Comando para MySQL
            DB::statement("ALTER TABLE users AUTO_INCREMENT = 5100");
        } elseif (DB::getDriverName() == 'pgsql') {
            // Comando para PostgreSQL
            DB::statement("ALTER SEQUENCE users_id_seq RESTART WITH 5100");
        } */

        $this->call(UserSeeder::class);
    }
}
