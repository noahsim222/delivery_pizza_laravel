<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'email' => 'admin@mail.com',
                'phone' => '+998998117371',
                'first_name' => 'John ',
                'last_name' => 'Doe',
                'role' => 'admin',
                'password' => Hash::make('12345')
            ]
        ];

        $this->store($users);
    }


    /**
     * @param array $users
     */
    protected function store(array $users): void
    {
        foreach ($users as $user) {
            User::firstOrCreate([
                'email' => $user['email']
            ], [
                'role'     => $user['role'],
                'first_name'     => $user['first_name'],
                'last_name'     => $user['last_name'],
                'phone'    => $user['phone'],
                'password' =>  $user['password'],
            ]);

        }
    }
}
