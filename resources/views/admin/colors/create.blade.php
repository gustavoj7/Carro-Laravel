@extends('layouts.admin')

@section('title', 'Nova cor - gustavo Motors')

@section('content')
    <div class="max-w-2xl">
        <h2 class="text-2xl font-semibold text-slate-900 mb-2">Cadastrar nova cor</h2>
        <p class="text-sm text-slate-500 mb-6">Defina cores padrão para manter descrições consistentes.</p>

        <form action="{{ route('admin.colors.store') }}" method="POST" class="bg-white rounded-2xl shadow border border-slate-100 p-6 space-y-6">
            @include('admin.colors.form')
        </form>
    </div>
@endsection
