<?php

namespace App\Http\Controllers\LandingPage;

use Illuminate\Http\Request;

class PelaporanPajakController
{
    protected $viewPath;

    public function __construct()
    {
        $this->viewPath = 'LandingPage.pages.PelaporanPajak.';
    }

    public function index()
    {
        return view($this->viewPath . 'index');
    }
}
