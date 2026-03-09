<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">

  </head>
<body>


  <div class="login-card">

  @if (session('erro'))
          <div class="alert-container">
              <div class="alert alert-danger text-center">
                  {{ session('erro') }}
              </div>
          </div>
  @endif

  <div class="containerLogin">
      <div class="logo">
        <img src="{{ asset('assets/img/logoCreio.png') }}" alt="">
      </div>

      <form action="{{ route('login.auth') }}" method="POST">
        @csrf

        <div class="formLogin">
          <div class="usuario">
            <label for="email" class="form-label">Email</label>
            <input
              type="email"
              class="form-control"
              id="email"
              name="email"
              placeholder="Digite seu email"
              value="{{ old('email') }}"
              required
            >
          </div>

          <div class="senha">
            <label for="password" class="form-label">Senha</label>
            <input
              type="password"
              class="form-control"
              id="password"
              name="password"
              placeholder="Digite sua senha"
              required
            >
          </div>
        </div>

        <button type="submit" class="btn btn-custom w-100">ENTRAR</button>
      </form>
  </div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
