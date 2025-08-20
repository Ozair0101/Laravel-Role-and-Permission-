<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            'create posts',
            'edit posts',
            'delete posts',
            'view posts',
            'manage departments',
            'create departments',
            'edit departments',
            'delete departments',
            'view departments',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign permissions to roles
        $adminRole = Role::where('name', 'Admin')->first();
        $editorRole = Role::where('name', 'Editor')->first();
        $viewerRole = Role::where('name', 'Viewer')->first();

        // Admin gets all permissions
        $adminRole->givePermissionTo(Permission::all());

        // Editor gets post permissions and view departments
        $editorRole->givePermissionTo([
            'create posts',
            'edit posts',
            'delete posts',
            'view posts',
            'view departments',
        ]);

        // Viewer gets only view permissions
        $viewerRole->givePermissionTo([
            'view posts',
            'view departments',
        ]);
    }
} 