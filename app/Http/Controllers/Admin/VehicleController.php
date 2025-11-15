<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::with(['brand', 'model', 'color'])
            ->latest()
            ->paginate(12);

        return view('admin.vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('admin.vehicles.create', $this->formData(new Vehicle()));
    }

    public function store(Request $request)
    {
        $validated = $this->validateVehicle($request);
        $galleryUrls = $this->extractGalleryUrls($request);
        $this->ensureGalleryHasMinimumPhotos($galleryUrls);

        $vehicle = Vehicle::create([
            'brand_id' => $validated['brand_id'],
            'vehicle_model_id' => $validated['vehicle_model_id'],
            'color_id' => $validated['color_id'],
            'title' => $validated['title'],
            'main_photo_url' => $validated['main_photo_url'],
            'year' => $validated['year'],
            'mileage' => $validated['mileage'],
            'price' => $validated['price'],
            'transmission' => $validated['transmission'] ?? null,
            'fuel_type' => $validated['fuel_type'] ?? null,
            'doors' => $validated['doors'] ?? null,
            'description' => $validated['description'],
            'features' => $this->extractFeatures($request),
            'status' => $validated['status'] ?? 'available',
        ]);

        $this->syncPhotos($vehicle, $galleryUrls);

        return redirect()
            ->route('admin.vehicles.index')
            ->with('status', 'Veículo cadastrado com sucesso!');
    }

    public function show(Vehicle $vehicle)
    {
        return redirect()->route('admin.vehicles.edit', $vehicle);
    }

    public function edit(Vehicle $vehicle)
    {
        $vehicle->load('photos');

        return view('admin.vehicles.edit', $this->formData($vehicle));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $this->validateVehicle($request);
        $galleryUrls = $this->extractGalleryUrls($request);
        $this->ensureGalleryHasMinimumPhotos($galleryUrls);

        $vehicle->update([
            'brand_id' => $validated['brand_id'],
            'vehicle_model_id' => $validated['vehicle_model_id'],
            'color_id' => $validated['color_id'],
            'title' => $validated['title'],
            'main_photo_url' => $validated['main_photo_url'],
            'year' => $validated['year'],
            'mileage' => $validated['mileage'],
            'price' => $validated['price'],
            'transmission' => $validated['transmission'] ?? null,
            'fuel_type' => $validated['fuel_type'] ?? null,
            'doors' => $validated['doors'] ?? null,
            'description' => $validated['description'],
            'features' => $this->extractFeatures($request),
            'status' => $validated['status'] ?? 'available',
        ]);

        $this->syncPhotos($vehicle, $galleryUrls);

        return redirect()
            ->route('admin.vehicles.index')
            ->with('status', 'Veículo atualizado com sucesso!');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()
            ->route('admin.vehicles.index')
            ->with('status', 'Veículo excluído com sucesso!');
    }

    /**
     * @return array<string, mixed>
     */
    private function validateVehicle(Request $request): array
    {
        return $request->validate([
            'brand_id' => ['required', 'exists:brands,id'],
            'vehicle_model_id' => ['required', 'exists:vehicle_models,id'],
            'color_id' => ['required', 'exists:colors,id'],
            'title' => ['required', 'string', 'max:150'],
            'main_photo_url' => ['required', 'url'],
            'year' => ['required', 'integer', 'between:1950,' . (date('Y') + 1)],
            'mileage' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'],
            'transmission' => ['nullable', 'string', 'max:60'],
            'fuel_type' => ['nullable', 'string', 'max:60'],
            'doors' => ['nullable', 'integer', 'between:2,6'],
            'description' => ['required', 'string'],
            'status' => ['nullable', 'in:available,reserved,sold'],
        ]);
    }

    private function extractGalleryUrls(Request $request): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $request->input('gallery_urls', '')))
            ->map(static fn ($url) => trim((string) $url))
            ->filter()
            ->values()
            ->all();
    }

    private function ensureGalleryHasMinimumPhotos(array $galleryUrls): void
    {
        if (count($galleryUrls) < 2) {
            throw ValidationException::withMessages([
                'gallery_urls' => 'Cadastre pelo menos duas fotos adicionais além da principal (total mínimo de 3).',
            ]);
        }
    }

    private function syncPhotos(Vehicle $vehicle, array $galleryUrls): void
    {
        $vehicle->photos()->delete();

        $vehicle->photos()->createMany(
            collect($galleryUrls)->map(function (string $url, int $index) {
                return [
                    'url' => $url,
                    'position' => $index + 1,
                ];
            })->all()
        );
    }

    private function extractFeatures(Request $request): array
    {
        return collect($request->input('features', []))
            ->map(fn ($item) => trim((string) $item))
            ->filter()
            ->values()
            ->all();
    }

    /**
     * @return array<string, mixed>
     */
    private function formData(Vehicle $vehicle): array
    {
        $vehicle->loadMissing('photos');

        return [
            'vehicle' => $vehicle,
            'brands' => Brand::orderBy('name')->get(),
            'models' => VehicleModel::with('brand')->orderBy('name')->get(),
            'colors' => Color::orderBy('name')->get(),
            'galleryString' => $vehicle->photos->sortBy('position')->pluck('url')->implode(PHP_EOL),
            'featureOptions' => [
                'Ar-condicionado',
                'Direção hidráulica',
                'Vidros elétricos',
                'Airbag',
                'Freios ABS',
                'Central multimídia',
                'Banco de couro',
            ],
        ];
    }
}
