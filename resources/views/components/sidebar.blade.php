@use ('Illuminate\Support\Facades\Storage')

<nav class="sidebar" aria-label="Menu lateral">
  <div class="menu-box">

    <div class="divLogo">
      <img src="{{ asset('assets/img/logoCreioSecundaria.png') }}" class="logoMenu" alt="Logo">
    </div>

    @auth
    <div class="sidebar-user">
      <button class="user-btn" type="button" id="userMenuBtn" aria-expanded="false">
      @if(auth()->user()->foto)
        <img src="{{ Storage::url(auth()->user()->foto) }}" class="user-avatar" style="object-fit:cover;border-radius:50%; width:36px; height:36px" alt="">
      @else
        <div class="user-avatar">
          {{ strtoupper(substr(auth()->user()->firstName ?? 'U', 0, 1)) }}
        </div>
      @endif
        <div class="user-meta">
          <div class="user-name">
            {{ (auth()->user()->firstName ?? '') . ' ' . (auth()->user()->lastName ?? '') }}
          </div>
          <div class="user-email">
            {{ auth()->user()->email }}
          </div>
        </div>

        <span class="user-caret">▾</span>
      </button>

      <div class="user-dropdown" id="userDropdown" hidden>
        <a class="user-item" href="{{ route('conta.index') }}">Minha conta</a>

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="user-item danger">
            Sair
          </button>
        </form>
      </div>
    </div>
    @endauth

    <ul class="menu" id="menuLateral">

      <li>
        <a class="menu-link dashboard-link" href="{{ route('index') }}">
          🏠 Dashboard
        </a>
      </li>

      @auth
      @php $user = auth()->user(); @endphp

      @if($user->temPermissao('alunos.gerenciar'))
      <li>
        <details>
          <summary>👩‍🎓 Alunos <span class="caret"></span></summary>
          <ul class="submenu">
            <li><a href="{{ route('alunos.create') }}">Cadastrar</a></li>
            <li><a href="{{ route('alunos.index') }}">Visualizar</a></li>
          </ul>
        </details>
      </li>
      @endif

      @if($user->temPermissao('profissionais.gerenciar'))
      <li>
        <details>
          <summary>🧑‍⚕️ Profissionais <span class="caret"></span></summary>
          <ul class="submenu">
            <li><a href="{{ route('profissionais.create') }}">Cadastrar</a></li>
            <li><a href="{{ route('profissionais.index') }}">Visualizar</a></li>
          </ul>
        </details>
      </li>
      @endif

      @if($user->temPermissao('escolas.gerenciar'))
      <li>
        <details>
          <summary>🏫 Escolas <span class="caret"></span></summary>
          <ul class="submenu">
            <li><a href="{{ route('escolas.create') }}">Cadastrar</a></li>
            <li><a href="{{ route('escolas.index') }}">Visualizar</a></li>
          </ul>
        </details>
      </li>
      @endif

      @php
        $temAtendimento = $user->temPermissao('agendamentos.visualizar')
                       || $user->temPermissao('agendamentos.gerenciar')
                       || $user->temPermissao('atendimentos.gerenciar')
                       || $user->temPermissao('listas_espera.gerenciar');
      @endphp
      @if($temAtendimento)
      <li>
        <details>
          <summary>📅 Atendimentos <span class="caret"></span></summary>
          <ul class="submenu">
            @if($user->temPermissao('agendamentos.visualizar') || $user->temPermissao('agendamentos.gerenciar'))
            <li><a href="{{ route('agendamentos') }}">Agendamentos</a></li>
            @endif
            @if($user->temPermissao('atendimentos.gerenciar'))
            <li><a href="{{ route('atendimento.lancar') }}">Lançar atendimento</a></li>
            @endif
            @if($user->temPermissao('listas_espera.gerenciar'))
            <li><a href="{{ route('listasEspera.filas') }}">Filas de espera</a></li>
            @endif
          </ul>
        </details>
      </li>
      @endif

      @if($user->temPermissao('relatorios.visualizar'))
      <li>
        <details>
          <summary>📊 Relatórios <span class="caret"></span></summary>
          <ul class="submenu">
            <li><a href="{{ route('relatorios.atendimentos') }}">Relatório de atendimentos</a></li>
            {{--<li><a href="#">Relatório por profissional</a></li>--}}
          </ul>
        </details>
      </li>
      @endif

      @php
        $temAdmin = $user->temPermissao('configuracoes.gerenciar')
                 || $user->temPermissao('listas_espera.gerenciar')
                 || $user->temPermissao('profissionais.gerenciar')
                 || $user->temPermissao('usuarios.gerenciar');
      @endphp
      @if($temAdmin)
      <li>
        <details>
          <summary>⚙️ Administração <span class="caret"></span></summary>
          <ul class="submenu">
            @if($user->temPermissao('configuracoes.gerenciar'))
            <li><a href="{{ route('diagnosticos.index') }}">Tipos de Diagnóstico</a></li>
            <li><a href="{{ route('deficiencias.index') }}">Tipos de Deficiência</a></li>
            <li><a href="{{ route('origensEncaminhamento.index') }}">Origens de Encaminhamento</a></li>
            @endif
            @if($user->temPermissao('listas_espera.gerenciar'))
            <li><a href="{{ route('listasEspera.index') }}">Cadastrar listas de Espera</a></li>
            @endif
            @if($user->temPermissao('profissionais.gerenciar'))
            <li><a href="{{ route('horarios.index') }}">Cadastrar horários de atendimento</a></li>
            @endif
            @if($user->temPermissao('usuarios.gerenciar'))
            <li><a href="{{ route('usuarios.index') }}">Usuários</a></li>
            <li><a href="{{ route('perfis.index') }}">Perfis e Permissões</a></li>
            @endif
          </ul>
        </details>
      </li>
      @endif

      @endauth

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
