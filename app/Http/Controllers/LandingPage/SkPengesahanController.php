<?php

namespace App\Http\Controllers\LandingPage;

use Illuminate\Http\Request;

class SkPengesahanController
{
    public function __construct()
    {
        $this->viewPath = 'LandingPage.pages.SkPengesahan.';
    }

    public function index()
    {
        return view($this->viewPath . 'index');
    }
}
