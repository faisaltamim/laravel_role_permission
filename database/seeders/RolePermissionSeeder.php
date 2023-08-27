<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        // Create Roles
        $roleSuperAdmin = Role::create( ['name' => 'superadmin', 'guard_name' => 'web'] );
        $roleAdmin      = Role::create( ['name' => 'admin', 'guard_name' => 'web'] );
        $roleEditor     = Role::create( ['name' => 'editor', 'guard_name' => 'web'] );
        $roleUser       = Role::create( ['name' => 'user', 'guard_name' => 'web'] );

        // Permission List as array
        $permissions = [

            // Dashboard
            'dashboard' => ['dashboard.view',
                'dashboard.edit',
            ],

            // Admin Permissions
            'admin'     => ['admin.create',
                'admin.view',
                'admin.edit',
                'admin.delete',
                'admin.approve'],

            // Role Permissions
            'role'      => [
                'role.create',
                'role.view',
                'role.edit',
                'role.delete',
                'role.approve',
            ],

            // Blog Permissions
            'blog'      => ['blog.create',
                'blog.view',
                'blog.edit',
                'blog.delete',
                'blog.approve'],

            // Profile Permissions
            'profile'   => ['profile.view',
                'profile.edit'],
        ];

        foreach ( $permissions as $permission_grp => $all_permission ) {
            // Create Permission
            foreach ( $all_permission as $permission ) {
                $permission = Permission::create( ['name' => $permission, 'group_name' => $permission_grp, 'guard_name' => 'web'] );
                $roleSuperAdmin->givePermissionTo( $permission );
                $permission->assignRole( $roleSuperAdmin );
            }
        }
    }
}
