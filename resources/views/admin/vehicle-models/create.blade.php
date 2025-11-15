@extends('layouts.admin')

@section('title', 'Novo modelo - gustavo Motors')

@section('content')
    <div class="max-w-2xl">
        <h2 class="text-2xl font-semibold text-slate-900 mb-2">Cadastrar novo modelo</h2>
        <p class="text-sm text-slate-500 mb-6">Relacione o modelo com a marca correta para facilitar filtros.</p>

        <form action="{{ route('admin.vehicle-models.store') }}" method="POST" class="bg-white rounded-2xl shadow border border-slate-100 p-6 space-y-6">
            @include('admin.vehicle-models.form')
        </form>
    </div>
@endsection
