<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Ficha do Aluno — {{ $aluno->nome }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: #111;
            background: #f0f0f0;
            padding: 30px;
        }

        .pagina {
            background: #fff;
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
            border-radius: 6px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.1);
        }

        .btn-imprimir {
            display: block;
            margin: 0 auto 24px;
            padding: 10px 28px;
            background: #1d4ed8;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
        }

        /* Cabeçalho */
        .cabecalho {
            text-align: center;
            border-bottom: 2px solid #1d4ed8;
            padding-bottom: 14px;
            margin-bottom: 20px;
        }
        .cabecalho h1 { font-size: 16px; text-transform: uppercase; color: #1d4ed8; }
        .cabecalho h2 { font-size: 13px; font-weight: normal; margin-top: 4px; }

        /* Seções */
        .secao { margin-bottom: 20px; }
        .secao-titulo {
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #1d4ed8;
            border-bottom: 1px solid #bfdbfe;
            padding-bottom: 4px;
            margin-bottom: 12px;
        }

        /* Grid de campos */
        .campos { display: flex; flex-wrap: wrap; gap: 10px; }
        .campo { display: flex; flex-direction: column; }
        .campo label { font-size: 10px; color: #64748b; text-transform: uppercase; margin-bottom: 2px; }
        .campo span { font-size: 13px; border-bottom: 1px solid #e2e8f0; padding-bottom: 3px; min-width: 100px; }

        .w-full    { width: 100%; }
        .w-half    { width: calc(50% - 5px); }
        .w-third   { width: calc(33% - 7px); }
        .w-quarter { width: calc(25% - 8px); }

        /* Autorização */
        .autorizacao {
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            padding: 16px;
            margin-top: 24px;
            font-size: 12px;
            line-height: 1.6;
        }
        .autorizacao p { margin-bottom: 10px; }
        .opcoes-auth { display: flex; gap: 24px; margin: 10px 0 20px; }
        .opcoes-auth label { display: flex; align-items: center; gap: 6px; font-size: 13px; }

        .assinatura {
            margin-top: 16px;
            border-top: 1px solid #111;
            padding-top: 4px;
            text-align: center;
            font-size: 11px;
            color: #475569;
            width: 60%;
            margin-left: auto;
            margin-right: auto;
        }

        /* Rodapé */
        .rodape {
            margin-top: 30px;
            text-align: right;
            font-size: 12px;
            color: #475569;
        }

        @media print {
            body { background: #fff; padding: 0; }
            .pagina { box-shadow: none; border-radius: 0; padding: 20px; }
            .btn-imprimir { display: none; }
        }
    </style>
</head>
<body>

<button class="btn-imprimir" onclick="window.print()">Imprimir / Salvar PDF</button>

<div class="pagina">

    {{-- Cabeçalho --}}
    <div class="cabecalho">
        <h1>Centro de Referência da Educação Inclusiva Operacional — CREIO</h1>
        <h2>Ficha de Matrícula do Aluno</h2>
    </div>

    {{-- Informações do aluno --}}
    <div class="secao">
        <div class="secao-titulo">Informações do Aluno</div>
        <div style="display:flex; gap:20px; align-items:flex-start;">

            @if($aluno->foto)
            <div style="flex-shrink:0;">
                <img src="{{ asset('storage/' . $aluno->foto) }}" alt="Foto do aluno"
                    style="width:110px; height:130px; object-fit:cover; border:1px solid #cbd5e1; border-radius:4px;">
            </div>
            @endif

            <div class="campos" style="flex:1;">
                <div class="campo w-half">
                    <label>Nome completo</label>
                    <span>{{ $aluno->nome }}</span>
                </div>
                <div class="campo w-quarter">
                    <label>Data de Nascimento</label>
                    <span>{{ $aluno->data_nascimento ? \Carbon\Carbon::parse($aluno->data_nascimento)->format('d/m/Y') : '—' }}</span>
                </div>
                <div class="campo w-quarter">
                    <label>Sexo</label>
                    <span>{{ $aluno->sexo === 'M' ? 'Masculino' : ($aluno->sexo === 'F' ? 'Feminino' : '—') }}</span>
                </div>
                <div class="campo w-quarter">
                    <label>Celular</label>
                    <span>{{ $aluno->celular ?? '—' }}</span>
                </div>
                <div class="campo w-quarter">
                    <label>Tel. Residencial</label>
                    <span>{{ $aluno->tel_residencial ?? '—' }}</span>
                </div>
            </div>

        </div>
    </div>

    {{-- Dados do aluno --}}
    <div class="secao">
        <div class="secao-titulo">Dados do Aluno</div>
        <div class="campos">
            <div class="campo w-half">
                <label>Endereço</label>
                <span>{{ $aluno->endereco ?? '—' }}</span>
            </div>
            <div class="campo w-quarter">
                <label>Número</label>
                <span>{{ $aluno->numero ?? '—' }}</span>
            </div>
            <div class="campo w-quarter">
                <label>Bairro</label>
                <span>{{ $aluno->bairro ?? '—' }}</span>
            </div>
            <div class="campo w-quarter">
                <label>CEP</label>
                <span>{{ $aluno->cep ?? '—' }}</span>
            </div>
            <div class="campo w-quarter">
                <label>Cidade</label>
                <span>{{ $aluno->cidade ?? '—' }}</span>
            </div>
            <div class="campo w-half">
                <label>Escola</label>
                <span>{{ $aluno->escola->nome ?? '—' }}</span>
            </div>
            <div class="campo w-quarter">
                <label>Série</label>
                <span>{{ $aluno->serie ?? '—' }}</span>
            </div>
            <div class="campo w-quarter">
                <label>Turno</label>
                <span>{{ $aluno->turno ?? '—' }}</span>
            </div>
            <div class="campo w-half">
                <label>Filiação 1</label>
                <span>{{ $aluno->filiacao1 ?? '—' }}</span>
            </div>
            <div class="campo w-half">
                <label>Filiação 2</label>
                <span>{{ $aluno->filiacao2 ?? '—' }}</span>
            </div>
        </div>
    </div>

    {{-- Saúde --}}
    <div class="secao">
        <div class="secao-titulo">Saúde</div>
        <div class="campos">
            <div class="campo w-third">
                <label>Alérgico a medicamento?</label>
                <span>{{ $aluno->alergico_medicamento ? 'Sim' : 'Não' }}
                    @if($aluno->alergico_medicamento && $aluno->alergico_medicamento_qual)
                        — {{ $aluno->alergico_medicamento_qual }}
                    @endif
                </span>
            </div>
            <div class="campo w-third">
                <label>Alérgico a alimento?</label>
                <span>{{ $aluno->alergico_alimento ? 'Sim' : 'Não' }}
                    @if($aluno->alergico_alimento && $aluno->alergico_alimento_qual)
                        — {{ $aluno->alergico_alimento_qual }}
                    @endif
                </span>
            </div>
            <div class="campo w-third">
                <label>Usa medicação específica?</label>
                <span>{{ $aluno->usa_medicacao ? 'Sim' : 'Não' }}
                    @if($aluno->usa_medicacao && $aluno->usa_medicacao_qual)
                        — {{ $aluno->usa_medicacao_qual }}
                    @endif
                </span>
            </div>
            @if($aluno->profissionais_crianca)
            <div class="campo w-full">
                <label>Profissionais que a criança já passou</label>
                <span>{{ $aluno->profissionais_crianca }}</span>
            </div>
            @endif
        </div>
    </div>

    {{-- Dados do responsável --}}
    <div class="secao">
        <div class="secao-titulo">Dados do Responsável</div>
        <div class="campos">
            <div class="campo w-half">
                <label>Nome completo</label>
                <span>{{ $aluno->resp_nome ?? '—' }}</span>
            </div>
            <div class="campo w-quarter">
                <label>Data de Nascimento</label>
                <span>{{ $aluno->resp_data_nascimento ? \Carbon\Carbon::parse($aluno->resp_data_nascimento)->format('d/m/Y') : '—' }}</span>
            </div>
            <div class="campo w-quarter">
                <label>Estado Civil</label>
                <span>{{ $aluno->resp_estado_civil ?? '—' }}</span>
            </div>
            <div class="campo w-quarter">
                <label>RG</label>
                <span>{{ $aluno->resp_rg ?? '—' }}</span>
            </div>
            <div class="campo w-quarter">
                <label>CPF</label>
                <span>{{ $aluno->resp_cpf ?? '—' }}</span>
            </div>
        </div>
    </div>

    {{-- Autorização de fotos --}}
    <div class="autorizacao">
        <p><strong>Utilização de Fotos e Imagens:</strong> A instituição utiliza fotos e filmagens dos alunos para divulgação na internet, jornais, folhetos e outros meios de comunicação, públicos e privados. Autorizo a publicação de fotos e filmagens do meu filho.</p>
        <div class="opcoes-auth">
            <label><input type="checkbox"> Sim</label>
            <label><input type="checkbox"> Não</label>
        </div>
        <div class="assinatura">
            <br>
            Assinatura do Responsável
        </div>
    </div>

    {{-- Rodapé --}}
    <div class="rodape">
        Guanambi, {{ \Carbon\Carbon::now()->translatedFormat('d \d\e F \d\e Y') }}
    </div>

</div>

</body>
</html>
