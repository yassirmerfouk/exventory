<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'tag_add',
            'tag_update',
            'tag_delete',
            'tag_show',
            'stock_add',
            'stock_update',
            'stock_delete',
            'stock_show',
            'category_add',
            'category_update',
            'category_delete',
            'category_show',
            'product_add',
            'product_update',
            'product_delete',
            'product_show',
            'product_access',
            'field_add',
            'field_update',
            'field_delete',
            'field_show',
            'project_add',
            'project_update',
            'project_delete',
            'project_show',
            'project_access',
            'role_add',
            'role_update',
            'role_delete',
            'role_show',
            'user_add',
            'user_update',
            'user_delete',
            'user_show',
            'invoice_add',
            'invoice_update',
            'invoice_delete',
            'invoice_show'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
