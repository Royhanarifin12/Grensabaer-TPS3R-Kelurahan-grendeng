<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProyekController extends Controller
{
    public function index()
    {
        $proyeks = Proyek::latest()->get();
        return view('Admin.pages.Proyek.index', compact('proyeks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = $request->file('image')->store('proyeks', 'public');

        Proyek::create([
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.proyek.index')->with('success', 'Gambar proyek berhasil ditambahkan.');
    }

    public function destroy(Proyek $proyek)
    {
        Storage::delete($proyek->image_path);

        $proyek->delete();

        return redirect()->route('admin.proyek.index')->with('success', 'Gambar proyek berhasil dihapus.');
    }
}