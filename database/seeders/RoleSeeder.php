<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin=Role::create(['name'=>'Superadmin']);
        $admin=Role::create(['name'=>'Admin']);
        $distributor=Role::create(['name'=>'Distributor']);
        $retailer=Role::create(['name'=>'Retailer']);
        $client=Role::create(['name'=>'Client']);

        $view_dashboard = Permission::create(['name' => 'view_dashboard']);
        
        $view_distributor_list = Permission::create(['name' => 'view_distributor_list']);
        $view_retailer_list = Permission::create(['name' => 'view_retailer_list']);
        $view_client_list = Permission::create(['name' => 'view_client_list']);
        
        $add_distributor = Permission::create(['name' => 'add_distributor']);
        $add_retailer = Permission::create(['name' => 'add_retailer']);
        $add_client = Permission::create(['name' => 'add_client']);

        $superadmin_permissions=[
            $view_dashboard,
            $view_distributor_list,
            $add_distributor,
            $add_retailer,
            $view_retailer_list,
            $add_client,
            $view_client_list
        ];

        $admin_permissions=[
            $view_dashboard,
            $view_distributor_list,
            $add_distributor,
            $add_retailer,
            $view_retailer_list,
            $add_client,
            $view_client_list
        ];

        $distributor_permissions=[
            $view_dashboard,
            $add_retailer,
            $view_retailer_list,
            $add_client,
            $view_client_list
        ];

        $retailer_permissions=[
            $view_dashboard,
            $add_client,
            $view_client_list
        ];

        $client_permissions=[];

        $superadmin->syncPermissions($superadmin_permissions);
        $admin->syncPermissions($admin_permissions);
        $client->syncPermissions($client_permissions);
        $distributor->syncPermissions($distributor_permissions);
        $retailer->syncPermissions($retailer_permissions);
        
    }
}