<?php

session_start();

include('../conexao/conexao.php');

$id = "";
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

if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {

    if (!isset($_GET["id"])) {
        header("lacation: ../index.html");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM cracha WHERE id=$id";
    $result = $connec->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: ../index.html");
        exit;
    }

    $nome = $row["nome"];
    $aso = $row["aso"];
    $funcao = $row["funcao"];
    $empresa = $row["empresa"];
    $liberacao = $row["liberacao"];
    $otq = $row["otq"];
    $taq = $row["taq"];
    $nr10 = $row["nr10"];
    $nr33 = $row["nr33"];
    $nr35 = $row["nr35"];
    $talha = $row["talha"];
    $pta = $row["pta"];
    $empilhadeira = $row["empilhadeira"];
    $pictograma = $row["pictograma"];
    $caminho_imagem = $row['caminho_imagem'];

} else {

    $id = $_POST["id"];
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
    $caminho_imagem = $_POST["caminho_imagem"];

    do {

        if ( empty($id) || empty($nome) || empty($aso) || empty($funcao) || empty($empresa)) {
            $errorMessage = "Você precisa de mais informações";
            break;
        }

        $sql = "UPDATE cracha " . 
                "SET nome = '$nome', aso = '$aso', funcao = '$funcao', empresa = '$empresa', liberacao = '$liberacao', otq = '$otq', taq = '$taq', nr10 = '$nr10', nr33 = '$nr33', nr35 = '$nr35', talha = '$talha', pta = '$pta', empilhadeira = '$empilhadeira', pictograma = '$pictograma', caminho_imagem = '$caminho_imagem'" .  
                "WHERE id = $id";
        $result = $connec->query($sql);

        if (!$result) {
            $errorMessage = "Tabela Invalida: " . $connec->error;
            break;
        }

        $successMessage = "Funcinario Atualizado";

        header("location: ../index.html");
        exit;

    } while (false);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/">
    <link rel="stylesheet" href="../styles/global.css">
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
        <section class="vizucenter">
            <div class="buttonsitens">
                <h2>Vizualizar carteirinha: <?php echo $nome; ?>.</h2>
            </div>
            <div class="btn-btn-col-sm-3 d-grid">
                <a class="btn btn-outline-primary" href="../paginas/cadastro.php" role="button">Voltar</a> 
            </div> 
        </section>
        <section class="buttonsitens">
            <div class="sectiondados">
            <img class="backgroud" src="../images/backgroud.jpg">

                <div class='dadosapp'>
                    <div class='img'">
                        <img  style='width: 2px, height: 2px;' src='<?php echo $caminho_imagem; ?>'>
                    </div>
                    <div class='dadosimpor'>
                        <article class='bord'>Nome: <?php echo $nome; ?></article>
                        <article class='bord'>ASO - Venc: <?php echo $aso; ?></article>
                        <article class='bord'>Função: <?php echo $funcao; ?></article>
                        <article class='bord'>Empresa: <?php echo $empresa; ?></article>
                    </div>
                </div>

                <div class='dados'>
                    <div class='title'>
                        <h1>
                            Esta ideintificação é pessoal e intransferivel. 
                            Comunicar imeditamente ao Sertor de Indentificação Pessoal,
                            em caso de perda ou extravio.
                        </h1>
                    </div>
                    <div class='trein'>
                        <div class='feito'>
                            <article></article>
                            <article></article>
                            <article></article>
                            <article></article>
                            <article></article>
                            <article></article>
                            <article></article>
                            <article></article>
                            <article></article>
                            <article></article>
                        </div>
                        <div class='treinamentos'>
                            <article>LT - Venc: <?php echo $liberacao; ?></article>
                            <article>OTQ - Venc: <?php echo $otq; ?></article>
                            <article>Trab. a Quent - Venc: <?php echo $taq; ?></article>
                            <article>NR 10 - Venc: <?php echo $nr10; ?></article>
                            <article>NR 33 - Venc: <?php echo $nr33; ?></article>
                            <article>NR 35 - Venc: <?php echo $nr35; ?></article>
                            <article>Talha Manu - Venc: <?php echo $talha; ?></article>
                            <article>PTA - Venc: <?php echo $pta; ?></article>
                            <article>Empilhadeira - Venc: <?php echo $empilhadeira; ?></article>
                            <article>Pictograma - Venc: <?php echo $pictograma; ?></article>
                        </div>
                    </div>
                    <div class='assinatura'>
                        <h1>
                            Assinatura da Segurança do Trabalho | Gestão EPS
                        </h1>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>