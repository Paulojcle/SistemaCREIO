

<nav class="sidebar" aria-label="Menu lateral">


  <div class="menu-box">
    
    <div class="divLogo">
      <img src="{{ asset('assets/img/logoCreioSecundaria.png') }}" class="logoMenu" alt="">
    </div>

    <ul class="menu" id="menuLateral">

      <li>
        <details>
            <summary>Alunos <span class="caret"></span></summary>
            <ul class="submenu">
                <li><a href="#"> Cadastrar</a></li>
                <li><a href="#">Visualizar</a></li>
                <li><a href="#">Editar</a></li>
            </ul>
        </details>
      </li>

      <li>
        <details>
          <summary>Profissionais <span class="caret"></span></summary>
          <ul class="submenu">
            <li><a href="#">Cadastrar</a></li>
            <li><a href="#">Visualizar</a></li>
            <li><a href="#">Editar</a></li>
          </ul>
        </details>
      </li>

      <li>
        <details>
          <summary>Escolas <span class="caret"></span></summary>
          <ul class="submenu">
            <li><a href="#">Cadastrar</a></li>
            <li><a href="#">Visualizar</a></li>
            <li><a href="#">Editar</a></li>
          </ul>
        </details>
      </li>

      <li>
        <details>
          <summary>Horários <span class="caret"></span></summary>
          <ul class="submenu">
            <li><a href="#">Cadastrar</a></li>
            <li><a href="#">Visualizar</a></li>
            <li><a href="#">Editar</a></li>
          </ul>
        </details>
      </li>

      <li>
        <details>
          <summary>Acompanhamento <span class="caret"></span></summary>
          <ul class="submenu">
            <li><a href="#">Listar agendamentos</a></li>
            <li><a href="#">Novo agendamento</a></li>
            <li><a href="#">Lançar atendimento</a></li>
            <li><a href="#">Listas de espera</a></li>
          </ul>
        </details>
      </li>

    </ul>
  </div>
</nav>

<script>
  // só um submenu aberto por vez
  document.addEventListener('DOMContentLoaded', () => {
    const menu = document.getElementById('menuLateral');
    if (!menu) return;

    const allDetails = Array.from(menu.querySelectorAll('details'));
    allDetails.forEach((d) => {
      d.addEventListener('toggle', () => {
        if (d.open) {
          allDetails.forEach((other) => {
            if (other !== d) other.removeAttribute('open');
          });
        }
      });
    });
  });
</script>