@extends('layouts.admin')

@section('title', 'Modelos - gustavo Motors')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm text-slate-500 uppercase tracking-widest">Catálogo</p>
            <h2 class="text-2xl font-semibold text-slate-900">Modelos cadastrados</h2>
        </div>
        <a href="{{ route('admin.vehicle-models.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 text-white font-semibold shadow hover:bg-indigo-500">
            + Novo modelo
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow border border-slate-100 overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 text-slate-500 uppercase tracking-widest text-xs">
                <tr>
                    <th class="px-6 py-3">Modelo</th>
                    <th class="px-6 py-3">Marca</th>
                    <th class="px-6 py-3">Carroceria</th>
                    <th class="px-6 py-3 w-32 text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($models as $model)
                <tr class="border-t border-slate-100">
                    <td class="px-6 py-4 font-semibold text-slate-800">{{ $model->name }}</td>
                    <td class="px-6 py-4 text-slate-500">{{ $model->brand->name }}</td>
                    <td class="px-6 py-4 text-slate-500">{{ $model->body_type ?? '-' }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.vehicle-models.edit', $model) }}" class="text-indigo-600 hover:underline">Editar</a>
                        <form action="{{ route('admin.vehicle-models.destroy', $model) }}" method="POST" class="inline-block ml-3" onsubmit="return confirm('Deseja remover este modelo?');">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 hover:underline">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-6 text-center text-slate-400">Nenhum modelo cadastrado.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $models->links() }}
    </div>
@endsection
