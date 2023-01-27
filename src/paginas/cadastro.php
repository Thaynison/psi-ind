<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/global.css">
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
                    <li><a href="cadastro.php" class="nav-link px-2 link-secondary">Cadastro</a></li>
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
        <section>
            <div class="buttonsitens">
                <h2>Lista de Colaboradores</h2>
                <a class="btn btn-outline-primary" href="../cadastro/create.php" role="button">Novo Funcionario</a>
                <a class='btn btn-outline-secondary' href='../cadastro/pdf.php?id=$row[id]'>Baixar PDF</a>
            </div>
        </section>
        <section>
        <div class="centertable">
            <table class="table">
                <thead>
                    <tr>
                        <th>Matricula</th>
                        <th>Colaborador</th>
                        <th>Aso</th>
                        <th>Função</th>
                        <th>Empresa</th>
                        <th>LT</th>
                        <th>OTQ</th>
                        <th>TaQ</th>
                        <th>NR10</th>
                        <th>NR33</th>
                        <th>NR35</th>
                        <th>Talha</th>
                        <th>PTA</th>
                        <th>Empilhadeira</th>
                        <th>Pictograma</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('../conexao/conexao.php');
    
                    if ($connec->connect_error) {
                        die("Erro na Conexão: " . $connec->connect_error);
                    }
    
                    $sql = "SELECT * FROM cracha ORDER BY nome ASC";
                    $result = $connec->query($sql);
    
                    if (!$result) {
                        die("Tabela Invalida: " . $connec->connect_error);
                    }
    
                    while($row = $result->fetch_assoc()) {
                        echo "
                            <tr>
                                <td>$row[cpf]</td>
                                <td>$row[nome]</td>
                                <td>$row[aso]</td>
                                <td>$row[funcao]</td>
                                <td>$row[empresa]</td>
                                <td>$row[liberacao]</td>
                                <td>$row[otq]</td>
                                <td>$row[taq]</td>
                                <td>$row[nr10]</td>
                                <td>$row[nr33]</td>
                                <td>$row[nr35]</td>
                                <td>$row[talha]</td>
                                <td>$row[pta]</td>
                                <td>$row[empilhadeira]</td>
                                <td>$row[pictograma]</td> 
                                <td>
                                    <a class='btn btn-outline-info' href='../cadastro/edit.php?id=$row[id]'>Editar</a>
                                    <a class='btn btn-outline-success' href='../cadastro/view.php?id=$row[id]'>Vizualizar</a>
                                    <a class='btn btn-outline-danger' href='../cadastro/delete.php?id=$row[id]'>Delete</a>

                                </td>
                            </tr>
                            
                            ";
                        }                
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
  <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>