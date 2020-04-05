<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
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
                'name' => 'Administrador',
                'email' => 'admin@admin.com',
                'password' => bcrypt('@0123456'),
                'active' => true,
                'admin' => true,
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        foreach ($users as $user) {
            $check = DB::table('users')->where('name', $user['name'])->first();
            if (!$check) {
                DB::table('users')->insert($user);
            }
        }
    }
}
