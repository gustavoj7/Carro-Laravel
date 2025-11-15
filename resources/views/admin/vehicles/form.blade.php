@csrf
<div class="space-y-8">
    <div class="grid gap-5 md:grid-cols-2">
        <div>
            <label class="text-sm font-semibold text-slate-600">Marca</label>
            <select name="brand_id" class="mt-2 w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" required>
                <option value="">Selecione...</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" @selected(old('brand_id', $vehicle->brand_id) == $brand->id)>{{ $brand->name }}</option>
                @endforeach
            </select>
            @error('brand_id')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-600">Modelo</label>
            <select name="vehicle_model_id" class="mt-2 w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" required>
                <option value="">Selecione...</option>
                @foreach ($models as $model)
                    <option value="{{ $model->id }}" @selected(old('vehicle_model_id', $vehicle->vehicle_model_id) == $model->id)>{{ $model->brand->name }} — {{ $model->name }}</option>
                @endforeach
            </select>
            @error('vehicle_model_id')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-600">Cor</label>
            <select name="color_id" class="mt-2 w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" required>
                <option value="">Selecione...</option>
                @foreach ($colors as $color)
                    <option value="{{ $color->id }}" @selected(old('color_id', $vehicle->color_id) == $color->id)>{{ $color->name }}</option>
                @endforeach
            </select>
            @error('color_id')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-600">Ano de fabricação</label>
            <input type="number" name="year" value="{{ old('year', $vehicle->year) }}" class="mt-2 w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" min="1950" max="{{ date('Y') + 1 }}" required>
            @error('year')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-600">Quilometragem</label>
            <input type="number" name="mileage" value="{{ old('mileage', $vehicle->mileage) }}" class="mt-2 w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" min="0" step="100" required>
            @error('mileage')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-600">Valor (R$)</label>
            <input type="number" name="price" value="{{ old('price', $vehicle->price) }}" class="mt-2 w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" min="0" step="1000" required>
            @error('price')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-600">Transmissão</label>
            <input type="text" name="transmission" value="{{ old('transmission', $vehicle->transmission) }}" class="mt-2 w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" placeholder="Automática, Manual...">
            @error('transmission')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-600">Combustível</label>
            <input type="text" name="fuel_type" value="{{ old('fuel_type', $vehicle->fuel_type) }}" class="mt-2 w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" placeholder="Flex, Gasolina...">
            @error('fuel_type')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-600">Nº de portas</label>
            <input type="number" name="doors" value="{{ old('doors', $vehicle->doors) }}" class="mt-2 w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" min="2" max="6">
            @error('doors')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-600">Situação</label>
            <select name="status" class="mt-2 w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500">
                @foreach (['available' => 'Disponível', 'reserved' => 'Reservado', 'sold' => 'Vendido'] as $value => $label)
                    <option value="{{ $value }}" @selected(old('status', $vehicle->status ?? 'available') === $value)>{{ $label }}</option>
                @endforeach
            </select>
            @error('status')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="space-y-5">
        <div>
            <label class="text-sm font-semibold text-slate-600">Título de destaque</label>
            <input type="text" name="title" value="{{ old('title', $vehicle->title) }}" class="mt-2 w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" required>
            @error('title')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="grid gap-5 md:grid-cols-2">
            <div>
                <label class="text-sm font-semibold text-slate-600">Foto principal (URL)</label>
                <input type="url" name="main_photo_url" value="{{ old('main_photo_url', $vehicle->main_photo_url) }}" class="mt-2 w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" placeholder="https://" required>
                @error('main_photo_url')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-600">Galeria (mínimo 2 URLs)</label>
                <textarea name="gallery_urls" rows="4" class="mt-2 w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" placeholder="https://...">{{ old('gallery_urls', $galleryString ?? '') }}</textarea>
                <p class="text-xs text-slate-500 mt-1">Digite uma URL por linha. Com a foto principal teremos pelo menos 3 imagens.</p>
                @error('gallery_urls')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-600">Descrição detalhada</label>
            <textarea name="description" rows="5" class="mt-2 w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('description', $vehicle->description) }}</textarea>
            @error('description')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-600 mb-2 block">Destaques do veículo</label>
            @php
                $selectedFeatures = collect(old('features', $vehicle->features ?? []));
            @endphp
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                @foreach ($featureOptions as $feature)
                    <label class="inline-flex items-center gap-2 text-sm font-medium text-slate-600 bg-slate-50 rounded-lg px-3 py-2">
                        <input type="checkbox" name="features[]" value="{{ $feature }}" class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
                               {{ $selectedFeatures->contains($feature) ? 'checked' : '' }}>
                        {{ $feature }}
                    </label>
                @endforeach
            </div>
            @error('features')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

<div class="mt-8 flex items-center gap-3">
    <button class="px-6 py-3 rounded-xl bg-indigo-600 text-white font-semibold shadow hover:bg-indigo-500">
        {{ $vehicle->exists ? 'Salvar alterações' : 'Cadastrar veículo' }}
    </button>
    <a href="{{ route('admin.vehicles.index') }}" class="text-slate-500 hover:text-slate-700 font-semibold">Cancelar</a>
</div>
