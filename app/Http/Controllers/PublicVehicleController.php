<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class PublicVehicleController extends Controller
{
    public function index(Request $request)
    {
        $vehicles = Vehicle::with(['brand', 'model', 'color'])
            ->when($request->filled('q'), function ($query) use ($request) {
                $term = '%' . $request->input('q') . '%';
                $query->where(function ($subQuery) use ($term) {
                    $subQuery->where('title', 'like', $term)
                        ->orWhereHas('brand', fn ($q) => $q->where('name', 'like', $term))
                        ->orWhereHas('model', fn ($q) => $q->where('name', 'like', $term));
                });
            })
            ->orderByDesc('created_at')
            ->paginate(9)
            ->withQueryString();

        return view('public.vehicles.index', compact('vehicles'));
    }

    public function show(Vehicle $vehicle)
    {
        $vehicle->load(['brand', 'model', 'color', 'photos']);
        $related = Vehicle::where('id', '!=', $vehicle->id)
            ->latest()
            ->limit(3)
            ->get();

        return view('public.vehicles.show', compact('vehicle', 'related'));
    }
}
