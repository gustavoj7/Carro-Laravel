@extends('layouts.admin')

@section('title', 'Editar modelo - gustavo Motors')

@section('content')
    <div class="max-w-2xl space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900">Editar modelo</h2>
                <p class="text-sm text-slate-500">Mantenha a base de modelos padronizada.</p>
            </div>
            <a href="{{ route('admin.vehicle-models.index') }}" class="text-sm text-indigo-600 hover:underline">← voltar</a>
        </div>

        <form action="{{ route('admin.vehicle-models.update', $vehicleModel) }}" method="POST" class="bg-white rounded-2xl shadow border border-slate-100 p-6 space-y-6">
            @method('PUT')
            @include('admin.vehicle-models.form')
        </form>
    </div>
@endsection
