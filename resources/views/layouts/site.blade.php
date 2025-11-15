@extends('layouts.base')

@section('body')
    <div class="min-h-screen flex flex-col">
        <header class="bg-white/90 shadow">
            <div class="max-w-6xl mx-auto px-4 py-4 flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
                <a href="{{ route('site.home') }}" class="text-2xl font-bold text-slate-900 tracking-tight">
                    gustavo<span class="text-indigo-600">Motors</span>
                </a>
                <nav class="flex items-center gap-4 text-sm font-semibold text-slate-600">
                    <a href="{{ route('site.home') }}" class="{{ request()->routeIs('site.home') ? 'text-indigo-600' : 'hover:text-indigo-600' }}">Estoque</a>
                    @if(auth()->check() && auth()->user()->isAdmin())
                        <a href="{{ route('admin.vehicles.index') }}" class="hover:text-indigo-600">Área administrativa</a>
                    @endif
                    @guest
                        <a href="{{ route('login') }}" class="px-4 py-2 rounded-full border border-indigo-100 text-indigo-600 hover:bg-indigo-50">
                            Entrar
                        </a>
                    @else
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="px-4 py-2 rounded-full border border-indigo-100 text-indigo-600 hover:bg-indigo-50">Sair</button>
                        </form>
                    @endguest
                </nav>
            </div>
        </header>

        <main class="flex-1">
            @yield('content')
        </main>

        <footer class="bg-slate-900 text-slate-200 py-6 mt-12">
            <div class="max-w-6xl mx-auto px-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3 text-sm">
                <p>© {{ now()->year }} gustavo Motors. Todos os direitos reservados.</p>
                <p>Projeto acadêmico desenvolvido em Laravel.</p>
            </div>
        </footer>
    </div>
@endsection
