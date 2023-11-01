<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();

            $data = [
                [
                    'id' => 1,
                    'name' => 'Administrator',
                    'email' => 'admin@gmail.com',
                    'password' => config('env.default_password'),
                    'role_id' => config('env.role.administrator'),
                ],
            ];

            foreach ($data as $value) {
                User::updateOrCreate(['id' => $value['id']], [
                    'name' => $value['name'],
                    'email' => $value['email'],
                    'password' => bcrypt($value['password']),
                    'role_id' => $value['role_id'],
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
        }
    }
}
