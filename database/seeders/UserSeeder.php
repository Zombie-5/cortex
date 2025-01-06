<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::firstOrCreate(
            ['tel' => 'admin@cortex.com'], // Condições para verificar existência
            [ // Dados a serem criados se não existir
                'tel' => 'admin@cortex.com',
                'password' => Hash::make('cortex@25'),
                'is_admin' => true,
            ]
        );

        if ($adminUser->wasRecentlyCreated) {
            // Exibe mensagem se o usuário foi criado agora
            $this->command->info('Usuário admin foi criado com sucesso!');
        } else {
            // Exibe mensagem se o usuário já existia
            $this->command->info('Usuário admin já existe.');
        }
    }
}
