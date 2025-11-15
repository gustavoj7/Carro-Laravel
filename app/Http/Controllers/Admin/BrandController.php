<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::orderBy('name')->paginate(10);

        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brand = new Brand();

        return view('admin.brands.create', compact('brand'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:brands,name'],
            'logo_url' => ['nullable', 'url'],
        ]);

        Brand::create($data);

        return redirect()
            ->route('admin.brands.index')
            ->with('status', 'Marca cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return redirect()->route('admin.brands.edit', $brand);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', "unique:brands,name,{$brand->id}"],
            'logo_url' => ['nullable', 'url'],
        ]);

        $brand->update($data);

        return redirect()
            ->route('admin.brands.index')
            ->with('status', 'Marca atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();

        return redirect()
            ->route('admin.brands.index')
            ->with('status', 'Marca removida com sucesso!');
    }
}
