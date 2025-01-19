<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

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

        $customers = [
            [
                'name' => 'Jane Doe',
                'email' => 'customer@mail.test',
                'password' => 'password',
                'email_verified_at' => now(),
            ],
        ];

        $this->createCustomers($customers);
    }

    public function createAdmins(array $admins)
    {

        $admin_role = Role::where('alias', Role::ADMIN_ROLE_ALIAS)->first();
        foreach ($admins as $admin) {

            $user = User::create($admin);

            $user->roles()->attach($admin_role?->id);
        }
    }

    public function createCustomers(array $customers)
    {

        $customer_role = Role::where('alias', Role::CLIENT_ROLE_ALIAS)->first();
        foreach ($customers as $customer) {

            $user = User::create($customer);

            $user->roles()->attach($customer_role?->id);
        }
    }
}
