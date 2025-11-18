<?php

namespace App\Http\Controllers\LandingPage;

use Illuminate\Http\Request;

class LegalitasController
{
    public function __construct()
    {
        $this->viewPath = 'LandingPage.pages.legalitas.';
    }

    public function index()
    {
        return view($this->viewPath . 'index');
    }
}