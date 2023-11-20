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
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name'=>'Director']);
        $role3 = Role::create(['name'=>'Staff']);
        $role4 = Role::create(['name'=>'Secretario']);
        $role5 = Role::create(['name'=>'Tutor']);
        $role6 = Role::create(['name'=>'Coordinador']);
        $role7 = Role::create(['name'=>'Jefe de area']);

        Permission::create(['name' =>'administrador'])->assignRole($role1);
        Permission::create(['name' =>'staff'])->assignRole($role3);
        Permission::create(['name' =>'tutor'])->assignRole($role5);
        Permission::create(['name' =>'jefe de area'])->assignRole($role7);
        Permission::create(['name' =>'coordinador'])->assignRole($role6);

        

    }
}
