@extends('layouts.base')

@section('body')
    <div class="min-h-screen bg-slate-100">
        <header class="bg-slate-900 text-white">
            <div class="max-w-6xl mx-auto px-4 py-4 flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-widest text-indigo-300">Painel Administrativo</p>
                    <h1 class="text-2xl font-semibold">gustavo Motors</h1>
                </div>
                <div class="flex items-center gap-4 text-sm">
                    <span>Olá, {{ auth()->user()->name ?? 'Administrador' }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="px-4 py-2 rounded-md bg-indigo-500 hover:bg-indigo-400 transition font-semibold">Sair</button>
                    </form>
                </div>
            </div>
        </header>

        <div class="max-w-6xl mx-auto px-4 py-8 grid gap-8 md:grid-cols-[220px,1fr]">
            <aside class="bg-white rounded-xl shadow border border-slate-100 p-4 space-y-2 text-sm font-semibold text-slate-600">
                <a href="{{ route('admin.vehicles.index') }}" class="flex items-center justify-between px-3 py-2 rounded-lg {{ request()->routeIs('admin.vehicles.*') ? 'bg-indigo-50 text-indigo-600' : 'hover:bg-slate-50' }}">
                    Veículos
                    <span class="text-xs text-slate-400">&rarr;</span>
                </a>
                <a href="{{ route('admin.brands.index') }}" class="flex items-center justify-between px-3 py-2 rounded-lg {{ request()->routeIs('admin.brands.*') ? 'bg-indigo-50 text-indigo-600' : 'hover:bg-slate-50' }}">
                    Marcas
                    <span class="text-xs text-slate-400">&rarr;</span>
                </a>
                <a href="{{ route('admin.vehicle-models.index') }}" class="flex items-center justify-between px-3 py-2 rounded-lg {{ request()->routeIs('admin.vehicle-models.*') ? 'bg-indigo-50 text-indigo-600' : 'hover:bg-slate-50' }}">
                    Modelos
                    <span class="text-xs text-slate-400">&rarr;</span>
                </a>
                <a href="{{ route('admin.colors.index') }}" class="flex items-center justify-between px-3 py-2 rounded-lg {{ request()->routeIs('admin.colors.*') ? 'bg-indigo-50 text-indigo-600' : 'hover:bg-slate-50' }}">
                    Cores
                    <span class="text-xs text-slate-400">&rarr;</span>
                </a>
                <a href="{{ route('site.home') }}" class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-slate-50">
                    Ver site
                    <span class="text-xs text-slate-400">&rarr;</span>
                </a>
            </aside>

            <main>
                @if (session('status'))
                    <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700">
                        {{ session('status') }}
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
@endsection
