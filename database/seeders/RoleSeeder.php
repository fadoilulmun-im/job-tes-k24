<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
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
                ],
                [
                    'id' => 2,
                    'name' => 'Member',
                ],
            ];

            foreach ($data as $value) {
                Role::updateOrCreate(['id' => $value['id']], [
                    'name' => $value['name'],
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
        }
    }
}
