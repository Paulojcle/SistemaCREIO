<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Horários – {{ $profissional->nome }}</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 32px;
      color: #111;
    }
    h1 { font-size: 20px; margin-bottom: 4px; }
    p.subtitulo { font-size: 13px; color: #555; margin-bottom: 24px; }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
    }
    th {
      background: #1a1a2e;
      color: #fff;
      padding: 10px 12px;
      text-align: left;
    }
    td {
      padding: 9px 12px;
      border-bottom: 1px solid #ddd;
    }
    tr:nth-child(even) td { background: #f5f5f5; }

    .btn-imprimir {
      display: inline-block;
      margin-bottom: 24px;
      padding: 8px 18px;
      background: #1a1a2e;
      color: #fff;
      border: none;
      border-radius: 6px;
      font-size: 14px;
      cursor: pointer;
    }

    @media print {
      .btn-imprimir { display: none; }
    }
  </style>
</head>
<body>

  <button class="btn-imprimir" onclick="window.print()">🖨 Imprimir / Salvar PDF</button>

  <h1>Horários de atendimento</h1>
  <p class="subtitulo">Profissional: <strong>{{ $profissional->nome }}</strong></p>

  @if($agendamentos->isEmpty())
    <p>Nenhum agendamento ativo encontrado para este profissional.</p>
  @else
    <table>
      <thead>
        <tr>
          <th>Dia</th>
          <th>Horário</th>
          <th>Aluno</th>
        </tr>
      </thead>
      <tbody>
        @foreach($agendamentos as $ag)
          <tr>
            <td>{{ $ag->horarioProfissional->nome_dia }}</td>
            <td>{{ \Carbon\Carbon::parse($ag->horarioProfissional->hora_inicio)->format('H:i') }}</td>
            <td>{{ $ag->aluno->nome }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif

</body>
</html>
