@extends('layouts.app')

@push('styles')
<style>
    .sobre-wrapper {
        min-height: 100vh;
        background-color: #163C25;
        padding: 50px 6%;
        display: flex;
        flex-direction: column;
        gap: 32px;
    }

    /* ── HERO ── */
    .sobre-hero {
        background: linear-gradient(135deg, #0f2f1f 0%, #1e5c38 100%);
        border-radius: 20px;
        padding: 56px 48px;
        display: flex;
        align-items: center;
        gap: 40px;
        border: 1px solid rgba(255,255,255,0.08);
    }

    .sobre-hero-logo {
        height: 90px;
        object-fit: contain;
        flex-shrink: 0;
        filter: brightness(0) invert(1);
        opacity: 0.9;
    }

    .sobre-hero-text h1 {
        font-size: 2rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 8px;
        letter-spacing: -0.5px;
    }

    .sobre-hero-text p {
        font-size: 1rem;
        color: rgba(255,255,255,0.65);
        line-height: 1.6;
    }

    /* ── CARDS DE SEÇÃO ── */
    .sobre-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 40px;
        border: 1px solid #e8e8e8;
    }

    .sobre-section-label {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #163C25;
        margin-bottom: 6px;
    }

    .sobre-section-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 20px;
    }

    .sobre-descricao {
        font-size: 0.97rem;
        color: #475569;
        line-height: 1.9;
        text-align: justify;
    }

    /* ── FUNCIONALIDADES ── */
    .sobre-features {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 16px;
        margin-top: 8px;
    }

    .sobre-feature-item {
        flex: 0 1 220px;
    }

    .sobre-feature-item {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 22px 20px;
        display: flex;
        align-items: flex-start;
        gap: 14px;
        transition: all .2s ease;
    }

    .sobre-feature-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.06);
        border-color: #c7d9ce;
    }

    .sobre-feature-icon {
        background: #e8f5ee;
        border-radius: 10px;
        padding: 10px;
        flex-shrink: 0;
        line-height: 1;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .sobre-feature-icon img {
        width: 24px;
        height: 24px;
        filter: invert(22%) sepia(50%) saturate(500%) hue-rotate(100deg) brightness(80%);
    }

    .sobre-feature-text strong {
        display: block;
        font-size: 0.88rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 4px;
    }

    .sobre-feature-text span {
        font-size: 0.8rem;
        color: #94a3b8;
        line-height: 1.5;
    }

    /* ── PARCEIROS ── */
    .sobre-parceiros-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-top: 8px;
    }

    .sobre-parceiro-card {
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 32px 24px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 16px;
        text-align: center;
        transition: all .2s ease;
    }

    .sobre-parceiro-card:hover {
        border-color: #163C25;
        box-shadow: 0 6px 20px rgba(22,60,37,0.1);
    }

    .sobre-parceiro-card img {
        height: 80px;
        object-fit: contain;
    }

    .sobre-logo-placeholder {
        height: 80px;
        width: 140px;
        background: #f1f5f9;
        border: 2px dashed #cbd5e1;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        font-size: 0.75rem;
        padding: 8px;
    }

    .sobre-parceiro-nome {
        font-size: 0.88rem;
        font-weight: 600;
        color: #1e293b;
    }

    .sobre-parceiro-tipo {
        font-size: 0.78rem;
        color: #94a3b8;
    }

    /* ── EQUIPE ── */
    .sobre-equipe-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 24px;
        margin-top: 8px;
    }

    .sobre-equipe-card {
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 32px 24px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 16px;
        text-align: center;
        transition: all .2s ease;
    }

    .sobre-equipe-card:hover {
        border-color: #163C25;
        box-shadow: 0 6px 20px rgba(22,60,37,0.1);
    }

    .sobre-equipe-foto-wrapper {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid #e8f5ee;
        flex-shrink: 0;
    }

    .sobre-equipe-foto-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .sobre-equipe-foto-wrapper--zoom img {
        width: 160%;
        height: 160%;
        margin-left: -10%;
        margin-top: -28%;
    }

    .sobre-equipe-foto-placeholder {
        width: 96px;
        height: 96px;
        border-radius: 50%;
        background: #f1f5f9;
        border: 2px dashed #cbd5e1;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        font-size: 0.7rem;
    }

    .sobre-equipe-nome {
        font-size: 0.95rem;
        font-weight: 700;
        color: #1e293b;
    }

    .sobre-equipe-cargo {
        font-size: 0.8rem;
        font-weight: 600;
        color: #163C25;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .sobre-equipe-info {
        font-size: 0.8rem;
        color: #64748b;
        line-height: 1.6;
    }

    /* ── RODAPÉ ── */
    .sobre-footer {
        text-align: center;
        font-size: 0.82rem;
        color: rgba(255,255,255,0.45);
        padding: 8px 0 4px;
    }

    @media (max-width: 640px) {
        .sobre-hero {
            flex-direction: column;
            text-align: center;
            padding: 40px 28px;
        }
        .sobre-hero-logo {
            height: 64px;
        }
    }
</style>
@endpush

@section('content')

<div class="sobre-wrapper">

    {{-- HERO --}}
    <div class="sobre-hero">
        <img src="{{ asset('assets/img/logoCreioSecundaria.png') }}" alt="Logo CREIO" class="sobre-hero-logo">
        <div class="sobre-hero-text">
            <h1>CREIO</h1>
            <p>Centro de Referência da Educação Inclusiva Operacional<br>
            Guanambi — Bahia</p>
        </div>
    </div>

    {{-- SOBRE O SISTEMA --}}
    <div class="sobre-card">
        <p class="sobre-section-label">O Projeto</p>
        <h2 class="sobre-section-title">Sobre o Sistema</h2>
        <p class="sobre-descricao">
            Este sistema foi desenvolvido como resultado de uma parceria entre a
            <strong>Prefeitura Municipal de Guanambi</strong>, por meio da
            <strong>Secretaria Municipal de Educação</strong>, e o
            <strong>Instituto Federal de Educação, Ciência e Tecnologia Baiano (IF Baiano)</strong>.
            <br><br>
            O objetivo é apoiar a gestão do CREIO, centralizando informações sobre alunos atendidos,
            profissionais, escolas parceiras e agendamentos, contribuindo para uma educação inclusiva
            mais organizada e eficiente no município.
        </p>
    </div>

    {{-- EQUIPE --}}
    <div class="sobre-card">
        <p class="sobre-section-label">Equipe</p>
        <h2 class="sobre-section-title">Desenvolvido por</h2>
        <div class="sobre-equipe-grid">

            <div class="sobre-equipe-card">
                <div class="sobre-equipe-foto-wrapper">
                    <img src="{{ asset('assets/img/imagemWoquiton.jpeg') }}" alt="Prof. Dr. Woquiton Lima Fernandes">
                </div>
                <div>
                    <div class="sobre-equipe-cargo">Orientador</div>
                    <div class="sobre-equipe-nome">Prof. Dr. Woquiton Lima Fernandes</div>
                </div>
                <div class="sobre-equipe-info">
                    Doutor em Educação Especial pela UFSCar<br>
                    Professor do IF Baiano e do PPGEduF - UNEB Campus Guanambi
                </div>
            </div>

            <div class="sobre-equipe-card">
                <div class="sobre-equipe-foto-wrapper sobre-equipe-foto-wrapper--zoom">
                    <img src="{{ asset('assets/img/imagemPaulo.jpeg') }}" alt="Paulo José Pereira Trindade">
                </div>
                <div>
                    <div class="sobre-equipe-cargo">Desenvolvedor</div>
                    <div class="sobre-equipe-nome">Paulo José Pereira Trindade</div>
                </div>
                <div class="sobre-equipe-info">
                    Estudante de Tecnologia em Análise e Desenvolvimento de Sistemas
                    IF Baiano - Campus Guanambi
                </div>
            </div>

        </div>
    </div>

    {{-- FUNCIONALIDADES --}}
    <div class="sobre-card">
        <p class="sobre-section-label">Funcionalidades</p>
        <h2 class="sobre-section-title">O que o sistema oferece</h2>
        <div class="sobre-features">
            <div class="sobre-feature-item">
                <div class="sobre-feature-icon">
                    <img src="{{ asset('assets/icons/person-circle.svg') }}" alt="Alunos">
                </div>
                <div class="sobre-feature-text">
                    <strong>Gestão de Alunos</strong>
                    <span>Cadastro completo com diagnósticos, deficiências e documentos</span>
                </div>
            </div>
            <div class="sobre-feature-item">
                <div class="sobre-feature-icon">
                    <img src="{{ asset('assets/icons/calendar-event.svg') }}" alt="Agendamentos">
                </div>
                <div class="sobre-feature-text">
                    <strong>Agendamentos</strong>
                    <span>Controle de atendimentos por profissional e horário</span>
                </div>
            </div>
            <div class="sobre-feature-item">
                <div class="sobre-feature-icon">
                    <img src="{{ asset('assets/icons/alarm.svg') }}" alt="Fila de Espera">
                </div>
                <div class="sobre-feature-text">
                    <strong>Fila de Espera</strong>
                    <span>Gerenciamento das listas de espera por serviço</span>
                </div>
            </div>
            <div class="sobre-feature-item">
                <div class="sobre-feature-icon">
                    <img src="{{ asset('assets/icons/houses-fill.svg') }}" alt="Escolas Parceiras">
                </div>
                <div class="sobre-feature-text">
                    <strong>Escolas Parceiras</strong>
                    <span>Cadastro e vínculo das escolas atendidas pelo CREIO</span>
                </div>
            </div>
            <div class="sobre-feature-item">
                <div class="sobre-feature-icon">
                    <img src="{{ asset('assets/icons/people.svg') }}" alt="Profissionais">
                </div>
                <div class="sobre-feature-text">
                    <strong>Profissionais</strong>
                    <span>Gestão de profissionais e seus horários de atendimento</span>
                </div>
            </div>
            <div class="sobre-feature-item">
                <div class="sobre-feature-icon">
                    <img src="{{ asset('assets/icons/journal.svg') }}" alt="Registros de Atendimento">
                </div>
                <div class="sobre-feature-text">
                    <strong>Registros de Atendimento</strong>
                    <span>Histórico completo de atendimentos realizados por aluno</span>
                </div>
            </div>
        </div>
    </div>

    {{-- PARCEIROS --}}
    <div class="sobre-card">
        <p class="sobre-section-label">Parceria</p>
        <h2 class="sobre-section-title">Desenvolvido em parceria com</h2>
        <div class="sobre-parceiros-grid">


            <div class="sobre-parceiro-card">
                    <img src="{{ asset('assets/img/logoCreio.png') }}" alt="Secretaria de Educação">
                <div>
                    <div class="sobre-parceiro-nome">Centro de Referência da Educação Especial Operacional</div>
                    <div class="sobre-parceiro-tipo">Instituição beneficiada</div>
                </div>
            </div>

            <div class="sobre-parceiro-card">
                 <img src="{{ asset('assets/img/logoPrefGuanambi.png') }}" alt="Prefeitura de Guanambi">
                <div>
                    <div class="sobre-parceiro-nome">Prefeitura de Guanambi</div>
                    <div class="sobre-parceiro-tipo">Poder Público Municipal</div>
                </div>
            </div>

            <div class="sobre-parceiro-card">
                    <img src="{{ asset('assets/img/logoIFGuanambi.png') }}" alt="IF Baiano">
                <div>
                    <div class="sobre-parceiro-nome">IF Baiano</div>
                    <div class="sobre-parceiro-tipo">Instituição de Ensino e Pesquisa</div>
                </div>
            </div>

        </div>
    </div>

    {{-- RODAPÉ --}}
    <div class="sobre-footer">
        CREIO · Guanambi/BA · {{ date('Y') }}
    </div>

</div>

@endsection
