<?php


namespace App\Http\ViewComposers;


use App\Models\AdminMenu;
use Illuminate\View\View;

class HomeComposer
{
    public function __construct()
    {
    }

    public function compose(View $view)
    {

        $menuHomeParents = json_decode(file_get_contents(config_path('app/adminMenu.json')), true);

        $view->with([
            'menuHomeParents' => $menuHomeParents,
        ]);
    }
}
