@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/escola/createEscola.css') }}">
@endpush

@section('content')

<div class="escola-page">
    <div class="escola-card">

        <h1 class="escola-title">Novo Usuário</h1>

        @if($errors->any())
            <div style="background:#fef2f2; border:1px solid #fca5a5; border-radius:8px; padding:14px 18px; margin-bottom:20px;">
                <strong style="color:#b91c1c;">Corrija os campos abaixo:</strong>
                <ul style="margin:8px 0 0 18px; color:#b91c1c; font-size:0.9rem;">
                    @foreach($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf

            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <label class="form-label">Nome <span style="color:#e11d48;">*</span></label>
                    <input type="text" name="firstName" value="{{ old('firstName') }}"
                        class="form-control @error('firstName') is-invalid @enderror">
                    @error('firstName') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label">Sobrenome <span style="color:#e11d48;">*</span></label>
                    <input type="text" name="lastName" value="{{ old('lastName') }}"
                        class="form-control @error('lastName') is-invalid @enderror">
                    @error('lastName') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label">E-mail <span style="color:#e11d48;">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12 col-md-3">
                    <label class="form-label">Senha <span style="color:#e11d48;">*</span></label>
                    <input type="password" name="password"
                        class="form-control @error('password') is-invalid @enderror">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12 col-md-3">
                    <label class="form-label">Confirmar Senha <span style="color:#e11d48;">*</span></label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <div class="col-12">
                    <label class="form-label">Perfis <span style="color:#e11d48;">*</span></label>
                    @error('perfis') <div style="color:#dc3545; font-size:0.875rem;">{{ $message }}</div> @enderror
                    <div style="display:flex; flex-wrap:wrap; gap:12px; margin-top:8px;">
                        @foreach($perfis as $perfil)
                            <label style="display:flex; align-items:center; gap:6px; cursor:pointer;">
                                <input type="checkbox" name="perfis[]" value="{{ $perfil->id }}"
                                    {{ in_array($perfil->id, old('perfis', [])) ? 'checked' : '' }}>
                                {{ $perfil->nome }}
                            </label>
                        @endforeach
                    </div>
                </div>

                @if($profissionais->isNotEmpty())
                <div class="col-12">
                    <label class="form-label">Vincular a um Profissional</label>
                    <select name="profissional_id" class="form-control">
                        <option value="">— Nenhum —</option>
                        @foreach($profissionais as $profissional)
                            <option value="{{ $profissional->id }}" {{ old('profissional_id') == $profissional->id ? 'selected' : '' }}>
                                {{ $profissional->nome }} ({{ $profissional->profissao }})
                            </option>
                        @endforeach
                    </select>
                </div>
                @endif
            </div>

            <div class="mt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>

        </form>
    </div>
</div>

@endsection
