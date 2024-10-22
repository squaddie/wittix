<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;

/**
 * Class SinglePageAppController
 * @package App\Http\Controllers\SinglePageAppController
 */
class SinglePageAppController extends Controller
{
    /**
     * @return Factory
     */
    public function index(): Factory
    {
        return view('layouts.app');
    }
}
