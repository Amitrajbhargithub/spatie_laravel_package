<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'can-show-product',
            'can-edit-product',
            'can-delete-product',
            'can-show-user',
            'can-edit-user',
            'can-delete-user',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
