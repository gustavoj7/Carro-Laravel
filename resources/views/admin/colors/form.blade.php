@csrf
<div class="space-y-5">
    <div>
        <label class="text-sm font-semibold text-slate-600">Nome da cor</label>
        <input type="text" name="name" value="{{ old('name', $color->name) }}" class="mt-2 w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" required>
        @error('name')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="text-sm font-semibold text-slate-600">Hexadecimal (opcional)</label>
        <input type="text" name="hex_code" value="{{ old('hex_code', $color->hex_code) }}" class="mt-2 w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" placeholder="#ffffff">
        @error('hex_code')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mt-6">
    <button class="px-6 py-3 rounded-xl bg-indigo-600 text-white font-semibold shadow hover:bg-indigo-500">
        {{ $color->exists ? 'Atualizar cor' : 'Cadastrar cor' }}
    </button>
    <a href="{{ route('admin.colors.index') }}" class="ml-3 text-slate-500 hover:text-slate-700">Cancelar</a>
</div>
