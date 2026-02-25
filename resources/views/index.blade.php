@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
@endpush


@section('content')
<div class="divTelaInicial">
    <section class="alunosMatriculados">
      <h3 class="cardTitle">Alunos matriculados</h3>

      <table class="tabelaAlunos">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Escola</th>
            <th>Filiação</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>Zefarino Caribanha Costa</td>
            <td>Escola Municipal Professor Sebastião Costa</td>
            <td>Sicrano de Tal<br>Fulano de Tal</td>
          </tr>

          <tr>
            <td>Sebastião da Silva</td>
            <td>Escola Municipal Jardim das Acácias</td>
            <td>Sicrano de Tal<br>Fulano de Tal</td>
          </tr>

          <tr>
            <td>Sicestiano Gonçalves de Almeida</td>
            <td>Escola Municipal Boa Vista</td>
            <td>Sicrano de Tal<br>Fulano de Tal</td>
          </tr>
        </tbody>
      </table>

      <div class="cardActions">
        <a href="#" class="btnVerMais">Ver mais</a>
      </div>
    </section>

    <!-- Segunda Sessão - Horários agendados -->
    <section class="horariosAgendados">
      <header class="cardPainelHeader">
        <h3 class="cardTitle">Horários agendados</h3>
        <span class="cardDate">29 de outubro de 2025</span>
      </header>

      <table class="tabelaAgenda">
        <thead>
          <tr>
            <th>07:00 - 07:30</th>
            <th>07:30 - 08:00</th>
            <th>08:10 - 08:40</th>
            <th>08:45 - 09:15</th>
          </tr>
        </thead>

        <tbody>
          <!-- LINHA 1 -->
          <tr>
            <td>
              <strong>Profissional:</strong> Fernanda Araújo Gonçalves<br>
              <strong>Aluno:</strong> Gabriel Almeida Bastos
            </td>
            <td>
              <strong>Profissional:</strong> Fernanda Araújo Gonçalves<br>
              <strong>Aluno:</strong> Gabriel Almeida Bastos
            </td>
            <td>
              <strong>Profissional:</strong> Fernanda Araújo Gonçalves<br>
              <strong>Aluno:</strong> Gabriel Almeida Bastos
            </td>
            <td>
              <strong>Profissional:</strong> Fernanda Araújo Gonçalves<br>
              <strong>Aluno:</strong> Gabriel Almeida Bastos
            </td>
          </tr>

          <!-- LINHA 2 -->
          <tr>
            <td>
              <strong>Profissional:</strong> Fernanda Araújo Gonçalves<br>
              <strong>Aluno:</strong> Gabriel Almeida Bastos
            </td>
            <td>
              <strong>Profissional:</strong> Fernanda Araújo Gonçalves<br>
              <strong>Aluno:</strong> Gabriel Almeida Bastos
            </td>
            <td>
              <strong>Profissional:</strong> Fernanda Araújo Gonçalves<br>
              <strong>Aluno:</strong> Gabriel Almeida Bastos
            </td>
            <td>
              <strong>Profissional:</strong> Fernanda Araújo Gonçalves<br>
              <strong>Aluno:</strong> Gabriel Almeida Bastos
            </td>
          </tr>
        </tbody>
      </table>

      <div class="cardActions">
        <a href="#" class="btnVerMais">Ver mais</a>
      </div>
    </section>

  

</div>

@endsection