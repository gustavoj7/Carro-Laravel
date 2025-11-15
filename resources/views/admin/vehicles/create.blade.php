@extends('layouts.admin')

@section('title', 'Novo veículo - gustavo Motors')

@section('content')
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900">Cadastrar novo veículo</h2>
                <p class="text-sm text-slate-500">Preencha todos os campos obrigatórios para publicar no site.</p>
            </div>
            <a href="{{ route('admin.vehicles.index') }}" class="text-sm text-indigo-600 hover:underline">← voltar</a>
        </div>

        <form action="{{ route('admin.vehicles.store') }}" method="POST" class="bg-white rounded-2xl shadow border border-slate-100 p-6">
            @include('admin.vehicles.form')
        </form>
    </div>
@endsection
