<?php

namespace App\Http\Controllers\LandingPage;

use Illuminate\Http\Request;

class KewajibanRetribusiController
{

    protected $viewPath;

    public function __construct()
    {
        $this->viewPath = 'LandingPage.pages.KewajibanRetribusi.';
    }

    public function index()
    {
        return view($this->viewPath . 'index');
    }
}
