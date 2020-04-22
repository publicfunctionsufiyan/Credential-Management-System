<?php

use App\Assigned;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \Spatie\Permission\Traits\HasRoles;

class DatabaseSeeder extends Seeder
{
    use HasRoles;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::updateOrCreate(['name' => 'create users']);
        Permission::updateOrCreate(['name' => 'delete users']);
        Permission::updateOrCreate(['name' => 'edit users']);
        Permission::updateOrCreate(['name' => 'view users']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::updateOrCreate(['name' => 'admin'])
        ->givePermissionTo(Permission::all());

        // or may be done by chaining
        $role = Role::updateOrCreate(['name' => 'user'])
        ->givePermissionTo(['edit users', 'view users']);

        $role = Role::updateOrCreate(['name' => 'owner'])
        ->givePermissionTo(Permission::all());   

        
        
        
       
        
       
    }
}
