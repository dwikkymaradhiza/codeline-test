<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Auth;

class ProfileComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $profiles = [
            'avatar' => asset('/uploads/avatar.jpeg')
        ];

        $view->with($profiles);
    }
}
