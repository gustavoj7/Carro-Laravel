@extends('layouts.admin')

@section('title', 'Marcas - gustavo Motors')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm text-slate-500 uppercase tracking-widest">Catálogo</p>
            <h2 class="text-2xl font-semibold text-slate-900">Marcas cadastradas</h2>
        </div>
        <a href="{{ route('admin.brands.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 text-white font-semibold shadow hover:bg-indigo-500">
            + Nova marca
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow border border-slate-100 overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 text-slate-500 uppercase tracking-widest text-xs">
                <tr>
                    <th class="px-6 py-3">Nome</th>
                    <th class="px-6 py-3">Logo</th>
                    <th class="px-6 py-3 w-32 text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($brands as $brand)
                <tr class="border-t border-slate-100">
                    <td class="px-6 py-4 font-semibold text-slate-800">{{ $brand->name }}</td>
                    <td class="px-6 py-4">
                        @if ($brand->logo_url)
                            <img src="{{ $brand->logo_url }}" alt="{{ $brand->name }}" class="h-8">
                        @else
                            <span class="text-xs text-slate-400">Sem logo</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.brands.edit', $brand) }}" class="text-indigo-600 hover:underline">Editar</a>
                        <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" class="inline-block ml-3" onsubmit="return confirm('Deseja remover esta marca?');">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 hover:underline">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-6 text-center text-slate-400">Nenhuma marca cadastrada ainda.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $brands->links() }}
    </div>
@endsection
