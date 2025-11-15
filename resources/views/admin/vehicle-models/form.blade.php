@csrf
<div class="space-y-5">
    <div>
        <label class="text-sm font-semibold text-slate-600">Marca</label>
        <select name="brand_id" class="mt-2 w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" required>
            <option value="">Selecione...</option>
            @foreach ($brands as $id => $name)
                <option value="{{ $id }}" @selected(old('brand_id', $vehicleModel->brand_id) == $id)>{{ $name }}</option>
            @endforeach
        </select>
        @error('brand_id')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="text-sm font-semibold text-slate-600">Nome do modelo</label>
        <input type="text" name="name" value="{{ old('name', $vehicleModel->name) }}" class="mt-2 w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" required>
        @error('name')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="text-sm font-semibold text-slate-600">Tipo de carroceria</label>
        <input type="text" name="body_type" value="{{ old('body_type', $vehicleModel->body_type) }}" class="mt-2 w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" placeholder="SUV, Hatch, Sedan...">
        @error('body_type')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mt-6">
    <button class="px-6 py-3 rounded-xl bg-indigo-600 text-white font-semibold shadow hover:bg-indigo-500">
        {{ $vehicleModel->exists ? 'Atualizar modelo' : 'Cadastrar modelo' }}
    </button>
    <a href="{{ route('admin.vehicle-models.index') }}" class="ml-3 text-slate-500 hover:text-slate-700">Cancelar</a>
</div>
