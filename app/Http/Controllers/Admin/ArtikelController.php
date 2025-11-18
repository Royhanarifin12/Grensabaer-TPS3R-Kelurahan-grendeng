<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::latest()->paginate(10);
        
        return view('Admin.pages.Artikel.index', compact('artikels'));
    }

    public function create()
    {
        return view('Admin.pages.Artikel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = $request->file('image')->store('artikels', 'public');

        Artikel::create([
            'title' => $request->title,
            'content' => $request->input('content'), 
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function show(string $id)
    {

    }

    public function edit(Artikel $artikel) 
    {
        return view('Admin.pages.Artikel.edit', compact('artikel'));
    }

    public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = $artikel->image; 

        if ($request->hasFile('image')) {
            Storage::delete($artikel->image);
            $imagePath = $request->file('image')->store('public/artikels');
        }

        $artikel->update([
            'title' => $request->title,
            'content' => $request->input('content'),
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Artikel $artikel)
    {
        Storage::delete($artikel->image);
        $artikel->delete();

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }
}