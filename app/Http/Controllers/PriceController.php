<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Service;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prices = Price::with('service')
            ->latest()
            ->paginate(10);

        return view('admin.prices.index', compact('prices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();

        return view('admin.prices.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'service_id'  => 'required|exists:services,id',
            'package_name' => 'required|max:255',
            'price'       => 'required|numeric',
            'duration'    => 'required|max:255',
        ]);

        Price::create([
            'service_id'  => $request->service_id,
            'package_name' => $request->package_name,
            'price'       => $request->price,
            'duration'    => $request->duration,
        ]);

        return redirect()
            ->route('admin.prices.index')
            ->with('success', 'Harga berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Price $price)
    {
        return redirect()->route('admin.prices.edit', $price);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Price $price)
    {
        $services = Service::all();

        return view('admin.prices.edit', compact('price', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Price $price)
    {
        $request->validate([
            'service_id'  => 'required|exists:services,id',
            'package_name' => 'required|max:255',
            'price'       => 'required|numeric',
            'duration'    => 'required|max:255',
        ]);

        $price->update([
            'service_id'  => $request->service_id,
            'package_name' => $request->package_name,
            'price'       => $request->price,
            'duration'    => $request->duration,
        ]);

        return redirect()
            ->route('admin.prices.index')
            ->with('success', 'Harga berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Price $price)
    {
        $price->delete();

        return redirect()
            ->route('admin.prices.index')
            ->with('success', 'Harga berhasil dihapus.');
    }
}
