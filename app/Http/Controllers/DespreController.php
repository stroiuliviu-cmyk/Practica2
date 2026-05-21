<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DespreController extends Controller
{
    public function index(): View
    {
        return view('despre');
    }
}
