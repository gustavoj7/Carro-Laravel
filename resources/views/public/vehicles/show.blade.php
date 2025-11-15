@extends('layouts.site')

@section('title', $vehicle->title . ' - gustavo Motors')

@section('content')
    <section class="bg-slate-900 text-white">
        <div class="max-w-6xl mx-auto px-4 py-12 grid gap-8 md:grid-cols-[1.1fr,0.9fr]">
            <div>
                <p class="uppercase text-xs tracking-[0.35em] text-indigo-300">{{ $vehicle->brand->name }} · {{ $vehicle->model->name }}</p>
                <h1 class="text-4xl md:text-5xl font-bold leading-tight mt-3">{{ $vehicle->title }}</h1>
                <p class="mt-4 text-lg text-slate-300">{{ $vehicle->description }}</p>
                <div class="mt-6 grid grid-cols-2 md:grid-cols-3 gap-4 text-sm text-slate-200">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-indigo-200">Ano</p>
                        <p class="text-2xl font-semibold text-white">{{ $vehicle->year }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-widest text-indigo-200">Quilometragem</p>
                        <p class="text-2xl font-semibold text-white">{{ number_format($vehicle->mileage, 0, ',', '.') }} km</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-widest text-indigo-200">Cor</p>
                        <p class="text-2xl font-semibold text-white">{{ $vehicle->color->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-widest text-indigo-200">Combustível</p>
                        <p class="text-2xl font-semibold text-white">{{ $vehicle->fuel_type ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-widest text-indigo-200">Câmbio</p>
                        <p class="text-2xl font-semibold text-white">{{ $vehicle->transmission ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-widest text-indigo-200">Portas</p>
                        <p class="text-2xl font-semibold text-white">{{ $vehicle->doors ?? '—' }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white/5 border border-white/10 rounded-2xl backdrop-blur p-6 flex flex-col gap-4">
                <p class="text-sm uppercase tracking-widest text-indigo-200">Investimento</p>
                <p class="text-4xl font-bold">R$ {{ number_format($vehicle->price, 2, ',', '.') }}</p>
                <p class="text-sm text-slate-200">Condições especiais para pagamento à vista ou financiamento com parceiros.</p>
                <div class="flex flex-wrap gap-2">
                    @foreach ($vehicle->features ?? [] as $feature)
                        <span class="px-3 py-1 rounded-full bg-white/10 border border-white/20 text-xs">{{ $feature }}</span>
                    @endforeach
                </div>
                <a href="mailto:contato@gustavomotors.com?subject=Tenho interesse no {{ $vehicle->title }}" class="inline-flex items-center justify-center gap-3 px-5 py-3 rounded-xl bg-white text-slate-900 font-semibold">
                    Quero negociar
                    <span>&rarr;</span>
                </a>
                <p class="text-xs text-slate-400">Referência interna: #{{ str_pad($vehicle->id, 4, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-4 py-10">
        <div class="grid gap-4 md:grid-cols-2">
            <img src="{{ $vehicle->main_photo_url }}" alt="{{ $vehicle->title }}" class="rounded-2xl w-full h-80 object-cover shadow-lg">
            <div class="grid gap-4">
                @foreach ($vehicle->photos as $photo)
                    <img src="{{ $photo->url }}" alt="Foto do veículo" class="rounded-2xl w-full h-48 object-cover shadow">
                @endforeach
            </div>
        </div>
    </section>

    @if ($related->isNotEmpty())
        <section class="max-w-6xl mx-auto px-4 py-8">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-semibold text-slate-900">Talvez você também goste</h2>
                <a href="{{ route('site.home') }}" class="text-sm text-indigo-600 font-semibold">Ver todos</a>
            </div>
            <div class="grid gap-6 md:grid-cols-3">
                @foreach ($related as $item)
                    <article class="bg-white rounded-2xl border border-slate-100 shadow overflow-hidden">
                        <img src="{{ $item->main_photo_url }}" alt="{{ $item->title }}" class="h-40 w-full object-cover">
                        <div class="p-4 space-y-2">
                            <p class="text-xs uppercase text-slate-400">{{ $item->brand->name }} · {{ $item->model->name }}</p>
                            <h3 class="text-lg font-semibold text-slate-900">{{ $item->title }}</h3>
                            <p class="text-indigo-600 font-bold">R$ {{ number_format($item->price, 2, ',', '.') }}</p>
                            <a href="{{ route('site.vehicles.show', $item) }}" class="text-sm text-slate-500 hover:text-indigo-600 font-semibold">Ver detalhes</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif
@endsection
