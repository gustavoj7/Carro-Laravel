@extends('layouts.admin')

@section('title', 'Veículos - gustavo Motors')

@section('content')
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <p class="text-sm text-slate-500 uppercase tracking-widest">Estoque</p>
            <h2 class="text-2xl font-semibold text-slate-900">Gerenciamento de veículos</h2>
            <p class="text-sm text-slate-500">Cadastre e acompanhe todas as oportunidades publicadas no site.</p>
        </div>
        <a href="{{ route('admin.vehicles.create') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-indigo-600 text-white font-semibold shadow hover:bg-indigo-500">
            + Novo veículo
        </a>
    </div>

    <div class="grid gap-5 md:grid-cols-2">
        @forelse ($vehicles as $vehicle)
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col md:flex-row">
                <img src="{{ $vehicle->main_photo_url }}" alt="{{ $vehicle->title }}" class="md:w-48 h-48 object-cover">
                <div class="p-5 flex-1 flex flex-col gap-3">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xs uppercase text-slate-400">{{ $vehicle->brand->name }} &middot; {{ $vehicle->model->name }}</p>
                            <h3 class="text-xl font-semibold text-slate-900">{{ $vehicle->title }}</h3>
                        </div>
                        <span class="text-xs px-3 py-1 rounded-full {{ $vehicle->status === 'available' ? 'bg-green-100 text-green-700' : ($vehicle->status === 'reserved' ? 'bg-amber-100 text-amber-700' : 'bg-slate-200 text-slate-700') }}">
                            {{ ucfirst(__($vehicle->status)) }}
                        </span>
                    </div>
                    <dl class="grid grid-cols-2 gap-4 text-sm text-slate-500">
                        <div>
                            <dt class="uppercase text-xs tracking-widest">Ano</dt>
                            <dd class="text-slate-900 font-semibold">{{ $vehicle->year }}</dd>
                        </div>
                        <div>
                            <dt class="uppercase text-xs tracking-widest">Km</dt>
                            <dd class="text-slate-900 font-semibold">{{ number_format($vehicle->mileage, 0, ',', '.') }} km</dd>
                        </div>
                        <div>
                            <dt class="uppercase text-xs tracking-widest">Cor</dt>
                            <dd class="text-slate-900 font-semibold">{{ $vehicle->color->name }}</dd>
                        </div>
                        <div>
                            <dt class="uppercase text-xs tracking-widest">Valor</dt>
                            <dd class="text-indigo-600 font-bold text-lg">R$ {{ number_format($vehicle->price, 2, ',', '.') }}</dd>
                        </div>
                    </dl>
                    <div class="flex items-center justify-between text-sm">
                        <a href="{{ route('site.vehicles.show', $vehicle) }}" target="_blank" class="text-slate-500 hover:text-indigo-600">Ver no site</a>
                        <div class="space-x-3">
                            <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="text-indigo-600 hover:underline font-semibold">Editar</a>
                            <form action="{{ route('admin.vehicles.destroy', $vehicle) }}" method="POST" class="inline-block" onsubmit="return confirm('Deseja excluir este veículo?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 hover:underline font-semibold">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-2 bg-white rounded-2xl border border-dashed border-slate-200 p-10 text-center text-slate-500">
                Nenhum veículo cadastrado. Que tal começar adicionando o primeiro?
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $vehicles->links() }}
    </div>
@endsection
