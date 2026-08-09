<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(10);

        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'before_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'after_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $before = $request->file('before_image')->store('galleries', 'public');
        $after = $request->file('after_image')->store('galleries', 'public');

        Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'before_image' => $before,
            'after_image' => $after,
            'is_active' => true,
        ]);

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function show(Gallery $gallery)
    {
        return view('admin.galleries.show', compact('gallery'));
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'before_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'after_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        if ($request->hasFile('before_image')) {

            Storage::disk('public')->delete($gallery->before_image);

            $data['before_image'] = $request->file('before_image')
                ->store('galleries', 'public');
        }

        if ($request->hasFile('after_image')) {

            Storage::disk('public')->delete($gallery->after_image);

            $data['after_image'] = $request->file('after_image')
                ->store('galleries', 'public');
        }

        $gallery->update($data);

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        Storage::disk('public')->delete($gallery->before_image);
        Storage::disk('public')->delete($gallery->after_image);

        $gallery->delete();

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil dihapus.');
    }
}
