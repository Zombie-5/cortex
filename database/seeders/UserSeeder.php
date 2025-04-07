<?php

namespace Database\Seeders;

use App\Models\Found;
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
                'tel' => 'admin@cortex.com',
                'password' => 'cortex@27',
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

        $found = Found::first();
        if (!$found) {
            Found::create([
                'liquid' => 500000, // Coloque o valor desejado
                'balance' => 0,  // Coloque o valor desejado
            ]);
            $this->command->info("Fundo criado com sucesso!");
        } else {
            $this->command->info("Já existe um fundo registrado.");
        }

        $user = User::firstOrCreate(
            ['tel' => '921621790'], // Condições para verificar existência
            [
                'tel' => '921621790',
                'password' => Hash::make('123456789')
            ]
        );

        if ($user->wasRecentlyCreated) {
            $this->command->info("Usuário {$user['tel']} foi criado com sucesso!");
        } else {
            $this->command->info("Usuário {$user['tel']} já existe.");
        }
    }
}
