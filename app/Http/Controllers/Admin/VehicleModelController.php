<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\VehicleModel;
use Illuminate\Http\Request;

class VehicleModelController extends Controller
{
    public function index()
    {
        $models = VehicleModel::with('brand')->orderBy('name')->paginate(10);

        return view('admin.vehicle-models.index', compact('models'));
    }

    public function create()
    {
        $vehicleModel = new VehicleModel();
        $brands = Brand::orderBy('name')->pluck('name', 'id');

        return view('admin.vehicle-models.create', compact('vehicleModel', 'brands'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'brand_id' => ['required', 'exists:brands,id'],
            'name' => ['required', 'string', 'max:120'],
            'body_type' => ['nullable', 'string', 'max:60'],
        ]);

        VehicleModel::create($data);

        return redirect()
            ->route('admin.vehicle-models.index')
            ->with('status', 'Modelo cadastrado com sucesso!');
    }

    public function show(VehicleModel $vehicleModel)
    {
        return redirect()->route('admin.vehicle-models.edit', $vehicleModel);
    }

    public function edit(VehicleModel $vehicleModel)
    {
        $brands = Brand::orderBy('name')->pluck('name', 'id');

        return view('admin.vehicle-models.edit', compact('vehicleModel', 'brands'));
    }

    public function update(Request $request, VehicleModel $vehicleModel)
    {
        $data = $request->validate([
            'brand_id' => ['required', 'exists:brands,id'],
            'name' => ['required', 'string', 'max:120'],
            'body_type' => ['nullable', 'string', 'max:60'],
        ]);

        $vehicleModel->update($data);

        return redirect()
            ->route('admin.vehicle-models.index')
            ->with('status', 'Modelo atualizado com sucesso!');
    }

    public function destroy(VehicleModel $vehicleModel)
    {
        $vehicleModel->delete();

        return redirect()
            ->route('admin.vehicle-models.index')
            ->with('status', 'Modelo excluído com sucesso!');
    }
}
