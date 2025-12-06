<?php

namespace App\Http\Controllers\LandingPage;

use App\Models\Testimoni; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 

class FormTestimonialController extends Controller 
{

    protected $viewPath;

    public function __construct()
    {
        $this->viewPath = 'LandingPage.pages.FormTestimoni.'; 
    }

    public function index()
    {
        return view($this->viewPath . 'index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required'],
            'no_telp' => ['required'],
            'alamat' => ['required'],
            'testimoni' => ['required','max:235'],
        ]);

        Testimoni::create([ 
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'testimoni' => $request->testimoni,
        ]);

        return redirect('/form-testimoni')->with('testimoniSuccess', 'true');
    }
}