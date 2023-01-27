<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/">
    <link href="styles/slide.css" rel="stylesheet">
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
                    <li><a href="login/login.php" class="nav-link px-2 link-secondary">Login</a></li>
                    <!-- <li><a href="paginas/cronograma.php" class="nav-link px-2 link-dark">Cronograma</a></li>
                    <li><a href="paginas/documentacao.php" class="nav-link px-2 link-dark">Documentação</a></li>
                    <li><a href="paginas/treinamentos.php" class="nav-link px-2 link-dark">Treinamentos</a></li> -->
                </ul>

                <div class="dropdown text-end">
                    <a href="index.html">
                        <img src="https://media.discordapp.net/attachments/1043295133396910172/1065036673865502731/logo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="content">
            <div class="slides">
                <input type="radio" name="slide" id="slide0" checked>
                <input type="radio" name="slide" id="slide1">
                <input type="radio" name="slide" id="slide2">
                <input type="radio" name="slide" id="slide3">

                <div class="slide s1">
                    <img src="images/calendario.jpg" alt="">
                </div>
                <div class="slide">
                    <img src="images/aviso.jpg" alt="">
                </div>
                <div class="slide">
                    <img src="images/lixo.jpg" alt="">
                </div>
                <div class="slide">
                    <img src="images/reuniao.jpg" alt="">
                </div>
            </div>


            <div class="navigation">
                <label class="bar" for="slide0"></label>
                <label class="bar" for="slide1"></label>
                <label class="bar" for="slide2"></label>
                <label class="bar" for="slide3"></label>
            </div>
        </div>
    </main>
  <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>