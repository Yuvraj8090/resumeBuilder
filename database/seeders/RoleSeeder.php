<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'super_admin',
                'label' => 'Super Admin',
            ],
            [
                'name' => 'editor',
                'label' => 'Template Editor',
            ],
            [
                'name' => 'support',
                'label' => 'Customer Support',
            ],
            [
                'name' => 'user',
                'label' => 'Standard User',
            ],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['name' => $role['name']], // Check if exists by name
                ['label' => $role['label']] // If not, create with label
            );
        }
    }
}