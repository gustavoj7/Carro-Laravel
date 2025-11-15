@csrf
<div class="space-y-5">
    <div>
        <label class="text-sm font-semibold text-slate-600">Nome da marca</label>
        <input type="text" name="name" value="{{ old('name', $brand->name) }}" class="mt-2 w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" required>
        @error('name')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="text-sm font-semibold text-slate-600">Logo (URL)</label>
        <input type="url" name="logo_url" value="{{ old('logo_url', $brand->logo_url) }}" class="mt-2 w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" placeholder="https://">
        @error('logo_url')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mt-6">
    <button class="px-6 py-3 rounded-xl bg-indigo-600 text-white font-semibold shadow hover:bg-indigo-500">
        {{ $brand->exists ? 'Atualizar marca' : 'Cadastrar marca' }}
    </button>
    <a href="{{ route('admin.brands.index') }}" class="ml-3 text-slate-500 hover:text-slate-700">Cancelar</a>
</div>
