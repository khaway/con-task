<?php

namespace App\Http\Controllers\Web;

use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class AppController
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function __invoke(): View|Factory|Application
    {
        return view('index');
    }
}
