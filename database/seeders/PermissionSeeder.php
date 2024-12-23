<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create-role',
            'edit-role',
            'delete-role',
            'create-user',
            'edit-user',
            'delete-user',
            'create-customer',
            'edit-customer',
            'delete-customer',
            'create-patient',
            'edit-patient',
            'delete-patient',
            'create-patient-visit',
            'edit-patient-visit',
            'delete-patient-visit',
            'create-invoice',
            'edit-invoice',
            'delete-invoice',
         ];

          // Looping and Inserting Array's Permissions into Permission Table
         foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
          }
    }
}
