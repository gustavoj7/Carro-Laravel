@extends('layouts.admin')

@section('title', 'Nova marca - gustavo Motors')

@section('content')
    <div class="max-w-2xl">
        <h2 class="text-2xl font-semibold text-slate-900 mb-2">Cadastrar nova marca</h2>
        <p class="text-sm text-slate-500 mb-6">Utilize links oficiais sempre que possível para manter o catálogo atualizado.</p>

        <form action="{{ route('admin.brands.store') }}" method="POST" class="bg-white rounded-2xl shadow border border-slate-100 p-6 space-y-6">
            @include('admin.brands.form')
        </form>
    </div>
@endsection
