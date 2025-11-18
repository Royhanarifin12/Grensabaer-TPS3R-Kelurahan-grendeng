<?php

namespace App\Http\Controllers\LandingPage;

use Illuminate\Http\Request;

class StrukturOrganisasiController
{
    public function __construct()
    {
        $this->viewPath = 'LandingPage.pages.StrukturOrganisasi.';
    }

    public function index()
    {
        return view($this->viewPath . 'index');
    }
}
