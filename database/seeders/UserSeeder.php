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
        $admins = [
            [
                'tel' => 'lilcrypto@cortex.com',
                'remember_token' => 'Lil Crypto',
                'password' => 'safewallet',
            ],
            [
                'tel' => 'youngvisa@cortex.com',
                'remember_token' => 'Young Visa',
                'password' => 'fastpay',
            ],
            [
                'tel' => 'admin@etoro.com',
                'remember_token' => 'Administrador Geral',
                'password' => 'etoro@27',
            ],
            [
                'tel' => '921621790',
                'password' => '123456789',
            ],
        ];

        foreach ($admins as $adminData) {
            $adminUser = User::firstOrCreate(
                ['tel' => $adminData['tel']], // Verifica se já existe pelo e-mail/telefone
                [
                    'password' => Hash::make($adminData['password']),
                    'is_admin' => true,
                    'remember_token' => $adminData['remember_token'] ?? null,
                ]
            );
        
            if ($adminUser->wasRecentlyCreated) {
                $this->command->info("Usuário admin {$adminData['tel']} foi criado com sucesso!");
            } else {
                $this->command->info("Usuário admin {$adminData['tel']} já existe.");
            }
        }
    }
}
