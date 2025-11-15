@extends('layouts.site')

@php use Illuminate\Support\Str; @endphp

@section('title', 'Estoque - gustavo Motors')

@section('content')
    <section class="bg-gradient-to-b from-slate-900 via-slate-900 to-slate-800 text-white">
        <div class="max-w-6xl mx-auto px-4 py-16 grid gap-6 md:grid-cols-[1.1fr,0.9fr]">
            <div>
                <p class="uppercase text-xs tracking-[0.3em] text-indigo-300">gustavo Motors</p>
                <h1 class="text-4xl md:text-5xl font-bold mt-3 leading-tight">Seu próximo carro está a um clique de distância.</h1>
                <p class="text-slate-300 mt-4 text-lg">Portfólio completo com fotos em alta resolução, ficha técnica detalhada e condições transparentes.</p>
                <div class="mt-6 flex items-center gap-4 text-sm text-slate-300">
                    <div>
                        <p class="text-3xl font-bold text-white">{{ $vehicles->total() }}</p>
                        <span>opções disponíveis</span>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-white">100%</p>
                        <span>processo digital</span>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-white">24h</p>
                        <span>tempo médio de retorno</span>
                    </div>
                </div>
            </div>
            <div class="bg-white/5 border border-white/10 rounded-2xl backdrop-blur p-6">
                <p class="text-sm uppercase tracking-widest text-indigo-200">Destaques</p>
                <ul class="mt-4 space-y-3 text-sm text-slate-200">
                    <li>• Fotos profissionais e ficha completa</li>
                    <li>• Marcas e modelos filtrados por especialistas</li>
                    <li>• Área administrativa para gestão rápida</li>
                </ul>
                <a href="{{ route('login') }}" class="mt-6 inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-white text-slate-900 font-semibold">
                    Sou administrador
                    <span>&rarr;</span>
                </a>
            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-4 py-12 space-y-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <p class="uppercase text-xs tracking-[0.35em] text-slate-400">Estoque completo</p>
                <h2 class="text-3xl font-semibold text-slate-900">Veículos disponíveis</h2>
            </div>
            <form method="GET" class="relative">
                <input type="search" name="q" value="{{ request('q') }}" placeholder="Busque por marca ou modelo" class="pl-10 pr-4 py-2 rounded-full border border-slate-200 focus:border-indigo-500 focus:ring-indigo-500">
                <span class="absolute left-3 top-2.5 text-slate-400">🔍</span>
            </form>
        </div>

        <div class="grid gap-6 md:grid-cols-3">
            @forelse ($vehicles as $vehicle)
                <article class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
                    <div class="relative">
                        <img src="{{ $vehicle->main_photo_url }}" alt="{{ $vehicle->title }}" class="h-56 w-full object-cover">
                        <span class="absolute top-3 left-3 text-xs px-3 py-1 rounded-full bg-slate-900/80 text-white">
                            {{ $vehicle->brand->name }} · {{ $vehicle->model->name }}
                        </span>
                        <span class="absolute top-3 right-3 text-xs px-3 py-1 rounded-full {{ $vehicle->status === 'available' ? 'bg-green-100 text-green-700' : ($vehicle->status === 'reserved' ? 'bg-amber-100 text-amber-700' : 'bg-slate-200 text-slate-700') }}">
                            {{ ucfirst(__($vehicle->status)) }}
                        </span>
                    </div>
                    <div class="p-5 flex flex-col gap-4 flex-1">
                        <div>
                            <h3 class="text-xl font-semibold text-slate-900">{{ $vehicle->title }}</h3>
                            <p class="text-sm text-slate-500">{{ $vehicle->year }} · {{ number_format($vehicle->mileage, 0, ',', '.') }} km · {{ $vehicle->color->name }}</p>
                        </div>
                        <p class="text-2xl font-bold text-indigo-600">R$ {{ number_format($vehicle->price, 2, ',', '.') }}</p>
                        <p class="text-sm text-slate-500 line-clamp-3">{{ Str::limit($vehicle->description, 120) }}</p>
                        <a href="{{ route('site.vehicles.show', $vehicle) }}" class="mt-auto inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-slate-900 text-white font-semibold hover:bg-indigo-700">
                            Ver detalhes
                            <span>&rarr;</span>
                        </a>
                    </div>
                </article>
            @empty
                <p class="text-center text-slate-500 col-span-3">Ainda não temos veículos cadastrados. Volte em breve!</p>
            @endforelse
        </div>

        <div>
            {{ $vehicles->appends(request()->only('q'))->links() }}
        </div>
    </section>
@endsection
