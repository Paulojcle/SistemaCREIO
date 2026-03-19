<nav class="sidebar" aria-label="Menu lateral">
  <div class="menu-box">

    <div class="divLogo">
      <img src="{{ asset('assets/img/logoCreioSecundaria.png') }}" class="logoMenu" alt="Logo">
    </div>

    @auth
    <div class="sidebar-user">
      <button class="user-btn" type="button" id="userMenuBtn" aria-expanded="false">
        <div class="user-avatar">
          {{ strtoupper(substr(auth()->user()->name ?? 'U',0,1)) }}
        </div>

        <div class="user-meta">
          <div class="user-name">
            {{ auth()->user()->name ?? 'Usuário' }}
          </div>
          <div class="user-email">
            {{ auth()->user()->email }}
          </div>
        </div>

        <span class="user-caret">▾</span>
      </button>

      <div class="user-dropdown" id="userDropdown" hidden>
        <a class="user-item" href="#">Minha conta</a>

        <form method="POST" action="">
          @csrf
          <button type="submit" class="user-item danger">
            Sair
          </button>
        </form>
      </div>
    </div>
    @endauth

    <ul class="menu" id="menuLateral">

      <!-- DASHBOARD -->
      <li>
        <a class="menu-link dashboard-link" href="{{ route('index') }}">
          🏠 Dashboard
        </a>
      </li>

      <!-- ALUNOS -->
      <li>
        <details>
          <summary>👩‍🎓 Alunos <span class="caret"></span></summary>
          <ul class="submenu">
            <li><a href="{{ route('alunos.create') }}">Cadastrar</a></li>
            <li><a href="{{ route('alunos.index') }}">Visualizar</a></li>
          </ul>
        </details>
      </li>

      <!-- PROFISSIONAIS -->
      <li>
        <details>
          <summary>🧑‍⚕️ Profissionais <span class="caret"></span></summary>
          <ul class="submenu">
            <li><a href="{{ route('profissionais.create') }}">Cadastrar</a></li>
            <li><a href="{{ route('profissionais.index') }}">Visualizar</a></li>
          </ul>
        </details>
      </li>

      <!-- ESCOLAS -->
      <li>
        <details>
          <summary>🏫 Escolas <span class="caret"></span></summary>
          <ul class="submenu">
            <li><a href="{{ route('escolas.create') }}">Cadastrar</a></li>
            <li><a href="{{ route('escolas.index') }}">Visualizar</a></li>
          </ul>
        </details>
      </li>

      <!-- ATENDIMENTOS -->
      <li>
        <details>
          <summary>📅 Atendimentos <span class="caret"></span></summary>
          <ul class="submenu">
            <li><a href="{{ route('agendamento') }}">Agendamentos</a></li>
            <li><a href="{{ route('atendimento.lancar') }}">Lançar atendimento</a></li>
            <li><a href="#">Lista de espera</a></li>
            <li><a href="#">Horários de atendimento</a></li>
          </ul>
        </details>
      </li>

      <!-- RELATÓRIOS -->
      <li>
        <details>
          <summary>📊 Relatórios <span class="caret"></span></summary>
          <ul class="submenu">
            <li><a href="#">Relatório de atendimentos</a></li>
            <li><a href="#">Relatório por aluno</a></li>
            <li><a href="#">Relatório por profissional</a></li>
            <li><a href="#">Exportar dados (PDF/Excel)</a></li>
          </ul>
        </details>
      </li>

      <!-- ADMINISTRAÇÃO -->
      <li>
        <details>
          <summary>⚙️ Administração <span class="caret"></span></summary>
          <ul class="submenu">
            <li><a href="{{ route('diagnosticos.index') }}">Tipos de Diagnóstico</a></li>
            <li><a href="{{ route('deficiencias.index') }}">Tipos de Deficiência</a></li>
            <li><a href="{{ route('origensEncaminhamento.index') }}">Origens de Encaminhamento</a></li>
            <li><a href="{{ route('listasEspera.index') }}">Cadastrar listas de Espera</a></li>
            <li><a href="#">Usuários</a></li>
            <li><a href="#">Perfis e Permissões</a></li>
          </ul>
        </details>
      </li>

    </ul>

  </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', () => {

  /* =========================
     FECHAR OUTROS DETAILS
  ========================== */
  const menu = document.getElementById('menuLateral');
  if (menu) {
    const allDetails = Array.from(menu.querySelectorAll('details'));

    allDetails.forEach((detail) => {
      detail.addEventListener('toggle', () => {
        if (detail.open) {
          allDetails.forEach((other) => {
            if (other !== detail) {
              other.removeAttribute('open');
            }
          });
        }
      });
    });
  }

  /* =========================
     DROPDOWN USUÁRIO
  ========================== */
  const btn = document.getElementById('userMenuBtn');
  const drop = document.getElementById('userDropdown');

  if (btn && drop) {

    const closeDropdown = () => {
      drop.hidden = true;
      btn.setAttribute('aria-expanded', 'false');
    };

    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      const willOpen = drop.hidden;
      drop.hidden = !willOpen;
      btn.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
    });

    drop.addEventListener('click', (e) => {
      e.stopPropagation();
    });

    document.addEventListener('click', () => {
      closeDropdown();
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        closeDropdown();
      }
    });
  }

});
</script>