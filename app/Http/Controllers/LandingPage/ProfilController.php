<?php

namespace App\Http\Controllers\LandingPage;

use Illuminate\Http\Request;

class ProfilController
{
    public function __construct()
    {
        $this->viewPath = 'LandingPage.pages.profil.';
    }

    public function index()
    {
        return view($this->viewPath . 'index');
    }
}
