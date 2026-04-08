<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class WelcomeController extends Controller
{
    /**
     * Display the public landing page.
     */
    public function index()
    {
        return Inertia::render('Welcome');
    }
}
