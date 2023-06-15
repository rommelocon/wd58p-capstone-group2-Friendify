<?php
namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use App\Models\Module;

class ResponsiveMainMenu extends Component
{
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        $consoleMenus = Module::where('parent_module_id', 2)->orderBy('sort_order')->orderBy('name')->get();
        return view('components.responsive-main-menu', compact('consoleMenus'));
    }

    public function compose(View $view)
    {
        $consoleMenus = Module::where('parent_module_id', 2)->orderBy('sort_order')->orderBy('name')->get();
        $view->with('consoleMenus', $consoleMenus);
    }
}   