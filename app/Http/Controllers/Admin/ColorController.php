<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::orderBy('name')->paginate(10);

        return view('admin.colors.index', compact('colors'));
    }

    public function create()
    {
        $color = new Color();

        return view('admin.colors.create', compact('color'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80', 'unique:colors,name'],
            'hex_code' => ['nullable', 'regex:/^#([A-Fa-f0-9]{6})$/'],
        ]);

        Color::create($data);

        return redirect()
            ->route('admin.colors.index')
            ->with('status', 'Cor cadastrada com sucesso!');
    }

    public function show(Color $color)
    {
        return redirect()->route('admin.colors.edit', $color);
    }

    public function edit(Color $color)
    {
        return view('admin.colors.edit', compact('color'));
    }

    public function update(Request $request, Color $color)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80', "unique:colors,name,{$color->id}"],
            'hex_code' => ['nullable', 'regex:/^#([A-Fa-f0-9]{6})$/'],
        ]);

        $color->update($data);

        return redirect()
            ->route('admin.colors.index')
            ->with('status', 'Cor atualizada com sucesso!');
    }

    public function destroy(Color $color)
    {
        $color->delete();

        return redirect()
            ->route('admin.colors.index')
            ->with('status', 'Cor excluída com sucesso!');
    }
}
