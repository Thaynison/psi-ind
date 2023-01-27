<?php
session_start();

include('../conexao/conexao.php');


$cpf = "";
$email = "";
$senha = "";
$nome = "";
$aso = "";
$funcao = "";
$empresa = "";
$liberacao = "";
$otq = "";
$taq = "";
$nr10 = "";
$nr33 = "";
$nr35 = "";
$talha = "";
$pta = "";
$empilhadeira = "";
$pictograma = "";
$caminho_imagem = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $cpf = $_POST["cpf"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $nome = $_POST["nome"];
    $aso = $_POST["aso"];
    $funcao = $_POST["funcao"];
    $empresa = $_POST["empresa"];
    $liberacao = $_POST["liberacao"];
    $otq = $_POST["otq"];
    $taq = $_POST["taq"];
    $nr10 = $_POST["nr10"];
    $nr33 = $_POST["nr33"];
    $nr35 = $_POST["nr35"];
    $talha = $_POST["talha"];
    $pta = $_POST["pta"];
    $empilhadeira = $_POST["empilhadeira"];
    $pictograma = $_POST["pictograma"];
    $caminho_imagem = $_POST["imagem"];

    do {

        if ( empty($id) || empty($nome) || empty($aso) || empty($funcao) || empty($empresa) ) {
            $errorMessage = "Você precisa de mais informações";
            break;
        }

        if(isset($_FILES['imagem'])) {
            $errors = array();
            $file_name = $_FILES['imagem']['name'];
            $file_size = $_FILES['imagem']['size'];
            $file_tmp = $_FILES['imagem']['tmp_name'];
            $file_type = $_FILES['imagem']['type'];
            $file_ext = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
        
            $extensions = array("jpeg", "jpg", "png");
            if (in_array($file_ext, $extensions) === false) {
                $errors[] = "Extensão não permitida, escolha uma imagem JPEG ou PNG.";
            }
            if ($file_size > 2097152) {
                $errors[] = 'Tamanho do arquivo deve ser menor que 2 MB';
            }
            if (empty($errors) == true) {
                $unique_name = uniqid() . "." . $file_ext;
                $image_path = "images/" . $unique_name;
                move_uploaded_file($file_tmp, $image_path);
                // Aqui você pode salvar o caminho da imagem no banco de dados
            } 
        }

        $sql = "INSERT INTO cracha (nome, cpf, aso, funcao, empresa, liberacao, otq, taq, nr10, nr33, nr35, talha, pta, empilhadeira, pictograma, caminho_imagem, senha, email) VALUES ('$nome', '$cpf', '$aso', '$funcao', '$empresa', '$liberacao', '$otq', '$taq', '$nr10', '$nr33', '$nr35', '$talha', '$pta', '$empilhadeira', '$pictograma', '$image_path', '$senha', '$email')";
        $result = $connec->query($sql);

        if (!$result) {
            $errorMessage = "Tabela Invalida: " . $connec->error;
            break;
        }

        $cpf = "";
        $email = "";
        $senha = "";
        $nome = "";
        $aso = "";
        $funcao = "";
        $empresa = "";
        $liberacao = "";
        $otq = "";
        $taq = "";
        $nr10 = "";
        $nr33 = "";
        $nr35 = "";
        $talha = "";
        $pta = "";
        $empilhadeira = "";
        $pictograma = "";
        $caminho_imagem = "";

        $successMessage = "Funcinario Cadastrado";

        header("location: create.php");
        exit;

    } while (false);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSI - Cadastro</title>
    <link href="../styles/global.css" rel="stylesheet">
    <link class="teste" rel="shortcut icon" href="imgs/psi-logo.png" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://media.discordapp.net/attachments/1043295133396910172/1065036673865502731/logo.png" rel="icon" width="10" height="10">
</head>
<body>
    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="../paginas/cadastro.php" class="nav-link px-2 link-secondary">Cadastro</a></li>
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
                <h2>Novo Funcionario</h2>
            </div>
        </section>
        <section>
            
            <div class="buttonsitens">

            <?php
            if (!empty($errorMessage)) {
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }   
            ?>
                <form method="post" enctype="multipart/form-data">

                    <div class="row mb-3">
                        <label class="col-sm-3-form-label">Nome do colaborador</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="nome" value="<?php echo $nome; ?>">
                        </div> 
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3-form-label">CPF</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="cpf" value="<?php echo $cpf; ?>">
                        </div> 
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3-form-label">E-mail</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                        </div> 
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3-form-label">Senha</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="senha" value="<?php echo $senha; ?>">
                        </div> 
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3-form-label">Aso</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="aso" value="<?php echo $aso; ?>">
                        </div> 
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3-form-label">Função</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="funcao" value="<?php echo $funcao; ?>">
                                <option >Auxiliar de Eletrica</option>
                                <option >Eletricista G1</option>
                                <option >Eletricista G2</option>
                                <option >Eletricista G3</option>
                                <option >Eletricista G4</option>
                                <option >Eletricista G5</option>
                                <option >Eletricista G5</option>
                                <option >Eletricista G7</option>
                                <option >Eletricista G8</option>
                                <option >Eletricista G9</option>
                                <option >Eletricista G10</option>
                                <option >Auxiliar de Instrumentação</option>
                                <option >Instrumentista G1</option>
                                <option >Instrumentista G2</option>
                                <option >Instrumentista G3</option>
                                <option >Instrumentista G4</option>
                                <option >Instrumentista G5</option>
                                <option >Instrumentista G5</option>
                                <option >Instrumentista G7</option>
                                <option >Instrumentista G8</option>
                                <option >Instrumentista G9</option>
                                <option >Instrumentista G10</option>
                                <option >Tecnico em Eletrica G1</option>
                                <option >Tecnico em Eletrica G2</option>
                                <option >Tecnico em Eletrica G3</option>
                                <option >Tecnico em Eletrica G4</option>
                                <option >Tecnico em Eletrica G5</option>
                                <option >Tecnico em Instrumentação G1</option>
                                <option >Tecnico em Instrumentação G2</option>
                                <option >Tecnico em Instrumentação G3</option>
                                <option >Tecnico em Instrumentação G4</option>
                                <option >Tecnico em Instrumentação G5</option>
                                <option >Encarregado</option>
                                <option >Planejador</option>
                                <option >Tec. Segurança do Trabalho</option>
                                <option >Administração</option>
                                <option >Supervisor</option>
                                <option >Donos</option>
                            </select>
                        </div> 
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-3-form-label">Empresa</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="empresa" value="<?php echo $empresa; ?>">
                        </div> 
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3-form-label">Liberação de Trabalho</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="liberacao" value="<?php echo $liberacao; ?>">
                        </div> 
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3-form-label">Observador de Trahalho a Quente</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="otq" value="<?php echo $otq; ?>">
                        </div> 
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3-form-label">Trabalho a Quente</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="taq" value="<?php echo $taq; ?>">
                        </div> 
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3-form-label">NR10</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="nr10" value="<?php echo $nr10; ?>">
                        </div> 
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3-form-label">NR33</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="nr33" value="<?php echo $nr33; ?>">
                        </div> 
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3-form-label">NR35</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="nr35" value="<?php echo $nr35; ?>">
                        </div> 
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3-form-label">Talha Manual</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="talha" value="<?php echo $talha; ?>">
                        </div> 
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3-form-label">PTA</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="pta" value="<?php echo $pta; ?>">
                        </div> 
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3-form-label">Empilhadeira</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="empilhadeira" value="<?php echo $empilhadeira; ?>">
                        </div> 
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3-form-label">Pictograma</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="pictograma" value="<?php echo $pictograma; ?>">
                        </div> 
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3-form-label">Foto</label>
                        <div class="col-sm-6">
                            <input type="file" name="imagem" class="form-control" value="<?php echo $caminho_imagem; ?>">
                        </div> 
                    </div>

                    <?php
                    if (!empty($successMessage)) {
                        echo "
                        <div class='row mb-3'>
                            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>$successMessage</strong>
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                        </div> 
                        ";
                    }
                    ?>

                    <div class="row mb-3">
                        <div class="offset-sm-3 col-sm-3 d-grid">
                            <button type="submit" class="btn btn-outline-success">Salvar</button> 
                        </div> 
                        <div class="col-sm-3 d-grid">
                            <a class="btn btn-outline-danger" href="../paginas/cadastro.php" role="button">Cancelar</a> 
                        </div> 
                    </div>

                </form>
            </div>
        </section>
    </main>
</body>
</html>