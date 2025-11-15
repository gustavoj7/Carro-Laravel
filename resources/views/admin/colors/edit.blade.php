@extends('layouts.admin')

@section('title', 'Editar cor - gustavo Motors')

@section('content')
    <div class="max-w-2xl space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900">Editar cor</h2>
                <p class="text-sm text-slate-500">Revise nomes e hexadecimais quando necessário.</p>
            </div>
            <a href="{{ route('admin.colors.index') }}" class="text-sm text-indigo-600 hover:underline">← voltar</a>
        </div>

        <form action="{{ route('admin.colors.update', $color) }}" method="POST" class="bg-white rounded-2xl shadow border border-slate-100 p-6 space-y-6">
            @method('PUT')
            @include('admin.colors.form')
        </form>
    </div>
@endsection
