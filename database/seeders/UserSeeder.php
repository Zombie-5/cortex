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
                'id' => 3,
                'tel' => 'lilcrypto@etoro.com',
                'name' => 'Lil Crypto',
                'password' => 'safewallet',
            ],
            [
                'id' => 2,
                'tel' => 'youngvisa@etoro.com',
                'name' => 'Young Visa',
                'password' => 'fastpay',
            ],
            [
                'id' => 1,
                'name' => 'Etoro Master',
                'tel' => 'admin@etoro.com',
                'password' => 'etoro@25',
            ],
        ];

        foreach ($admins as $adminData) {
            $adminUser = User::firstOrCreate(
                ['tel' => $adminData['tel']], // Verifica se já existe pelo e-mail/telefone
                [
                    'id' => $adminData['id'],
                    'password' => Hash::make($adminData['password']),
                    'is_admin' => true,
                    'name' => $adminData['name'],
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
                'liquid' => 2,
                'balance' => 0,
            ]);
            $this->command->info("Fundo criado com sucesso!");
        } else {
            $this->command->info("Já existe um fundo registrado.");
        }
    }
}
