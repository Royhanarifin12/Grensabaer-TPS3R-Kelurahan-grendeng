<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PanduanWargaController extends Controller
{

    public function index()
    {
        return view('LandingPage.pages.PanduanWarga.index');
    }
}