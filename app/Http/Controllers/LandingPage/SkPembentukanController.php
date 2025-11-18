<?php

namespace App\Http\Controllers\LandingPage;

use Illuminate\Http\Request;

class SkPembentukanController
{
    public function __construct()
    {
        $this->viewPath = 'LandingPage.pages.SkPembentukan.';
    }

    public function index()
    {
        return view($this->viewPath . 'index');
    }
}
