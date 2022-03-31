<?php

namespace App\View\Components\Admin;

use App\Models\Menu;
use Illuminate\View\Component;
use function view;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $userData = auth()->user();
//        $permissions = UserLevel::where('level_id', $userData->level_id)
//            ->first()->permissions()->orderBy('order')->get();
        $permissions = Menu::join('user_permissions', 'menus.menu_id', '=', 'user_permissions.menu_id')
            ->join('user_levels', 'user_permissions.level_id', '=', 'user_levels.level_id')
            ->where('user_levels.level_id', $userData->level_id)
            ->orderBy('order')
            ->get();
        return view('theme-admin.sidebar', compact('permissions'));
    }
}
