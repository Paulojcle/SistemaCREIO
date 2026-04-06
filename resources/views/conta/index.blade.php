@use('Illuminate\Support\Facades\Storage')
@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/crud.css') }}">
@endpush

@section('content')
<div class="aluno-page">
<div class="aluno-card">

    <div class="aluno-card-header">
        <h2>Minha Conta</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    {{-- ===== DADOS PESSOAIS ===== --}}
    <div class="mt-4">
        <h5 class="mb-3">Dados Pessoais</h5>

        <form action="{{ route('conta.perfil') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">Nome</label>
                    <input type="text" name="firstName" class="form-control @error('firstName') is-invalid @enderror"
                           value="{{ old('firstName', $user->firstName) }}">
                    @error('firstName')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Sobrenome</label>
                    <input type="text" name="lastName" class="form-control @error('lastName') is-invalid @enderror"
                           value="{{ old('lastName', $user->lastName) }}">
                    @error('lastName')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-8">
                    <label class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $user->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label class="form-label">Foto de perfil</label><br>

                    @if($user->foto)
                        <img src="{{ Storage::url($user->foto) }}"
                             style="width:80px;height:80px;object-fit:cover;border-radius:50%;margin-bottom:8px;">
                    @endif

                    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Salvar dados</button>
            </div>

        </form>
    </div>

    <hr class="my-4">

    {{-- ===== ALTERAR SENHA ===== --}}
    <div>
        <h5 class="mb-3">Alterar Senha</h5>

        <form action="{{ route('conta.senha') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">Senha atual</label>
                    <input type="password" name="senha_atual" class="form-control @error('senha_atual') is-invalid @enderror">
                    @error('senha_atual')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nova senha</label>
                    <input type="password" name="nova_senha" class="form-control @error('nova_senha') is-invalid @enderror">
                    <small class="text-muted">Mínimo 8 caracteres, com maiúscula, número e caractere especial (@$!%*#?&).</small>
                    @error('nova_senha')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Confirmar nova senha</label>
                    <input type="password" name="nova_senha_confirmation" class="form-control">
                </div>

            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-warning">Alterar senha</button>
            </div>

        </form>
    </div>

</div>
</div>
@endsection
