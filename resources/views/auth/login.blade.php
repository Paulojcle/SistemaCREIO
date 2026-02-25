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

  <div class="containerLogin">
      <div class="logo">
        <img src="{{ asset('assets/img/logoCreio.png') }}" alt="">
      </div>

      <form>
        <div class="formLogin">
            <div class="usuario">
            <label for="usuario" class="form-label">Usuário</label>
            <input type="text" class="form-control" id="usuario" placeholder="Digite seu usuário">
          </div>
          <div class="senha">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" placeholder="Digite sua senha">
          </div>
        </div>
        
        <button type="submit" class="btn btn-custom w-100">ENTRAR</button>
      </form>
    </div>
  </div>
    

 

  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
