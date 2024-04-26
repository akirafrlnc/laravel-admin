<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::factory()->create([
            'name' => 'Admin'
        ]);
        $editor = Role::factory()->create([
            'name' => 'Editor'
        ]);
        $viewer = Role::factory()->create([
            'name' => 'Viewer'
        ]);
        $permissions = Permission::all();

        $admin->permissions()->attach($permissions->pluck('id'));
        $editor->permissions()->attach($permissions->pluck('id'));
        $editor->permissions()->detach(4);
        $viewer->permissions()->attach([1, 3, 5, 7]);
    }
}
