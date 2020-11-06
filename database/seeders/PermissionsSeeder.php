<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          // Reset cached roles and permissions
          app()[PermissionRegistrar::class]->forgetCachedPermissions();

         foreach(config('authorization.permissions') as $permission)
         {
             Permission::firstOrCreate(['name' => $permission]);
         }
    }
}
