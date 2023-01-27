<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="../styles/login.css" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/">
    <link href="https://media.discordapp.net/attachments/1043295133396910172/1065036673865502731/logo.png" rel="icon" width="10" height="10">
    <title>PSI Industrial, Eletrica, Instrumentação</title>
</head>
<body>
    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <!-- <li><a href="cadastro.php" class="nav-link px-2 link-secondary">Cadastro</a></li> -->
                    <!-- <li><a href="#" class="nav-link px-2 link-dark">Cronograma</a></li>
                    <li><a href="#" class="nav-link px-2 link-dark">Documentação</a></li>
                    <li><a href="#" class="nav-link px-2 link-dark">Treinamentos</a></li> -->
                </ul>

                <div class="dropdown text-end">
                    <a href="../login/logout.php">
                        <img src="https://media.discordapp.net/attachments/1043295133396910172/1065036673865502731/logo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="login-container">
            <form method="post" action="verificacao.php">
                <h1>Efetuar Login</h1>
                <div class="form-group">
                    <input placeholder="CPF" type="text" id="cpf" name="cpf" required>
                </div>
                <div class="form-group">
                    <input placeholder="SENHA" type="password" id="senha" name="senha" required>
                </div>
                <button type="submit">Entrar</button>
            </form>
        </div>
    </main>
</body>
</html>
