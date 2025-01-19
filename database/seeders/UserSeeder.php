<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Factories\UserFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'name' => 'John Doe',
                'email' => 'johndoe@mail.test',
                'password' => 'password',
                'email_verified_at' => now(),
            ],
        ];

        $this->createAdmins($admins);
    }

    public function createAdmins(array $admins)
    {

        $admin_role = Role::where('alias', Role::ADMIN_ROLE_ALIAS)->first();
        foreach ($admins as $admin) {

            $user = User::create($admin);

            $user->roles()->attach($admin_role?->id);
        }
    }
}
