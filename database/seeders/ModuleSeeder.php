<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groupMainMenus = [
            ['name' => 'GUEST'],
            ['name' => 'CONSOLE'],
            ['name' => 'USER'],
        ];

        foreach ($groupMainMenus as $menu) {
            \App\Models\Module::factory()->create($menu);
        }

        $consoleMenus = [
            ['name' => 'Home', 'route' => 'home', 'parent_module_id' => 2, 'sort_order' => 'a'],
            ['name' => 'Profile', 'route' => 'profile.index', 'parent_module_id' => 2, 'sort_order' => 'b'],
            ['name' => 'Friend', 'route' => 'friend.index', 'parent_module_id' => 2, 'sort_order' => 'c'],
        ];

        foreach ($consoleMenus as $menu) {
            \App\Models\Module::factory()->create($menu);
        }
    }
}
