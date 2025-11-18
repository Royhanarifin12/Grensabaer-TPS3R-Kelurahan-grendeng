<?php

namespace App\Http\Controllers\LandingPage;

use Illuminate\Http\Request;

class AktaNotarisController
{

    protected $viewPath;

    public function __construct()
    {
        $this->viewPath = 'LandingPage.pages.AktaNotaris.';
    }

    public function index()
    {
        return view($this->viewPath . 'index');
    }
}
