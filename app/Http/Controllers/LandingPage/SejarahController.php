<?php

namespace App\Http\Controllers\LandingPage;

use Illuminate\Http\Request;

class SejarahController
{
    public function __construct()
    {
        $this->viewPath = 'LandingPage.pages.sejarah.';
    }

    public function index()
    {
        return view($this->viewPath . 'index');
    }
}
