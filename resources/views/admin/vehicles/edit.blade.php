@extends('layouts.admin')

@section('title', 'Editar veículo - gustavo Motors')

@section('content')
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs uppercase text-slate-400">Edição</p>
                <h2 class="text-2xl font-semibold text-slate-900">{{ $vehicle->title }}</h2>
                <p class="text-sm text-slate-500">Atualize as informações visíveis na vitrine pública.</p>
            </div>
            <a href="{{ route('admin.vehicles.index') }}" class="text-sm text-indigo-600 hover:underline">← voltar</a>
        </div>

        <form action="{{ route('admin.vehicles.update', $vehicle) }}" method="POST" class="bg-white rounded-2xl shadow border border-slate-100 p-6">
            @method('PUT')
            @include('admin.vehicles.form')
        </form>
    </div>
@endsection
