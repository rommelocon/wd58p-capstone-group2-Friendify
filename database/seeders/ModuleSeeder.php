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
            ['name' => 'Home', 'icon_class' => 'fa-solid fa-house fa-xl', 'route' => 'home', 'parent_module_id' => 2, 'sort_order' => 'a'],
            ['name' => 'Profile', 'icon_class' => 'fa-solid fa-user fa-xl', 'route' => 'profile.index', 'parent_module_id' => 2, 'sort_order' => 'b'],
            ['name' => 'Friend', 'icon_class' => 'fa-solid fa-users fa-xl', 'route' => 'friend.index', 'parent_module_id' => 2, 'sort_order' => 'c'],
            ['name' => 'Search', 'icon_class' => 'fa-solid fa-magnifying-glass fa-xl', 'route' => 'search.index', 'parent_module_id' => 2, 'sort_order' => 'd'],
        ];

        foreach ($consoleMenus as $menu) {
            \App\Models\Module::factory()->create($menu);
        }
    }
}
