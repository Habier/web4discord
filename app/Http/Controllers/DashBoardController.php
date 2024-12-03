<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class DashBoardController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Dashboard');
    }
}
