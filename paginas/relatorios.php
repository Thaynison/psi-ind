<?php
include '../conexao/conexao.php';
// =====================================================================
$BuscaProjetos = "SELECT id, titulo, documento, pep, valor, mes, status, responsavel  FROM projetos";
$result_BuscaProjetos = mysqli_query($conexao, $BuscaProjetos );
// =====================================================================

// =====================================================================
if (isset($_POST['dados'])) {
    $dados = $_POST['dados'];

    $conexao->set_charset("utf8");
    $linhas = explode("\n", $dados);

    foreach ($linhas as $linha) {
        $colunas = explode("\t", $linha);

        $colunas = array_map('trim', $colunas);
        $colunas = array_map(function($coluna) {
            return htmlspecialchars_decode(htmlspecialchars($coluna, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        }, $colunas);

        if (count($colunas) === 8 && !in_array('', $colunas, true)) {
            list($titulo, $documento, $pep, $valor, $mes, $status, $responsavel, $empresa) = $colunas;

            $sql = "INSERT INTO projetos (titulo, documento, pep, valor, mes, status, responsavel, empresa) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("sssdssss", $titulo, $documento, $pep, $valor, $mes, $status, $responsavel, $empresa);

            if ($stmt->execute()) {
            } else {
                echo "Erro na inserção: " . $stmt->error . "<br>";
            }

            $stmt->close();
        } else {
            echo "Uma ou mais colunas estão vazias ou faltando.<br>";
        }
    }

    echo "Inserção de todos os dados concluída.";
    header("Location: relatorios.php");
    exit();
} elseif (isset($_POST['dados'])) {
    echo "Dados não recebidos.";
}
// =====================================================================

// =====================================================================
if (isset($_POST['criarplanilha'])) {
    $titulo = $_POST["titulo"];
    $documento = $_POST["documento"];
    $pep = $_POST["pep"];
    $valor = $_POST["valor"];
    $mes = $_POST["mes"];
    $status = $_POST["status"];
    $responsavel = $_POST["responsavel"];
    $empresa = "Suzano";

    $query = "INSERT INTO projetos (titulo, documento, pep, valor, mes, status, responsavel, empresa) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("ssssssss", $titulo, $documento, $pep, $valor, $mes, $status, $responsavel, $empresa);
    
    if ($stmt->execute()) {
        header("Location: relatorios.php");
        exit();
    } else {
        echo "Erro ao salvar o projeto: " . $stmt->error;
    }
    $stmt->close();
    $conexao->close();
}
// =====================================================================

if (isset($_POST['salvaredicao'])) {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $documento = $_POST['documento'];
    $pep = $_POST['pep'];
    $valor = $_POST['valor'];
    $mes = $_POST['mes'];
    $status = $_POST['status'];
    $responsavel = $_POST['responsavel'];

    mysqli_set_charset($conexao, 'utf8');
    
    $Update_projetos = "UPDATE projetos SET titulo='$titulo', documento='$documento', pep='$pep', valor='$valor', mes='$mes', status='$status', responsavel='$responsavel' WHERE id='$id'";
    $Update_result = mysqli_query($conexao, $Update_projetos);

    if ($Update_result) {
        header("Location: relatorios.php");
        exit();
    } else {
        echo "Erro ao atualizar os dados";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/styles.css">
    <link rel="stylesheet" href="../Styles/Deck.css">
    <link rel="stylesheet" href="../Styles/Element.css">
    <link rel="stylesheet" href="../Styles/Impround.css">
    <link rel="stylesheet" href="../Styles/relatorios.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="../img/psi-logo.png" type="image/x-icon">
    <script src="scripts/link.js"></script>
    <title>PSI - Planejamento</title>
</head>
<body>
    <div class="hub">
    <div class="bar1">
            <div class="deck1"><img src="../img/psi-logo.png" alt="logo empresa"></div>
            <div class="deck2">
                <button class="btn-bar" id="dashboard-btn"><i class="fa-regular fa-layer-group"></i> Dashboard</button>
                <button class="btn-bar" id="documentos-btn"><i class="fa-regular fa-table"></i> Administrativo</button>
                <button class="btn-bar" id="relatorios-btn"><i class="fa-regular fa-folder-open"></i> Projetos</button>
                <button class="btn-bar" id="perfil-btn"><i class="fa-regular fa-circle-user"></i> Perfil</button>
                <button class="btn-bar" id="configuracoes-btn"><i class="fa-regular fa-gear"></i> Configurações</button>
            </div>
            <div class="deck3">
                <button class="btn-bar"><i class="fa-solid fa-right-from-bracket fa-bounce"></i> Log Out</button>
                
            </div>
        </div>
        <div class="bar2">
        <div class="element1">
                <div class="title"><h1>Projetos</h1></div>
                <div class="options">
                    <div class="busca1">
                        <input class="input" type="text">
                        <i class="fa-regular fa-magnifying-glass"></i>
                    </div>
                    <select class="busca2">
                    </select>
                </div>
            </div>
            <div class="element2">
                <div class="pag3">
                    <div class="docs">
                        <div class="add4">
                            <h1 class="components"></h1>
                            <h1 class="components">Documento ID</h1>
                            <h1 class="components">Nome Projeto</h1>
                            <h1 class="components">Status</h1>
                            <h1 class="components">Valor</h1>
                        </div>

                        <div class="add5-container">
                            <?php
                            while ($row = mysqli_fetch_assoc($result_BuscaProjetos)) {?>
                                <div class="add5">
                                     <h1 class="components" style="font-size: 15px; display: flex; justify-content: space-evenly; align-items: center;">
                                        <i class="fa-regular fa-eye view-project" data-project-id="<?php echo $row['id']; ?>"></i>
                                        <i class="fa-regular fa-pen-to-square edit-project" data-project-id="<?php echo $row['id']; ?>"></i>
                                        <i class="fa-regular fa-calendar-days calendar-project" data-project-id="<?php echo $row['id']; ?>"></i>
                                    </h1>
                                    <h1 class="components">#<?php echo utf8_encode($row['documento']); ?></h1>
                                    <h1 class="components"><?php echo utf8_encode($row['titulo']); ?></h1>
                                    <h1 class="components"><?php echo utf8_encode($row['status']); ?></h1>
                                    <h1 class="components">R$ <?php echo number_format(utf8_encode($row['valor']), 2, ',', '.'); ?></h1>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="pag4">
                    <div class="docs">
                        <div class="deck4">
                            <h1>Opções</h1>
                            <i class="fa-regular fa-thumbtack fa-bounce"></i>
                        </div>
                        <div class="deck5">
                            <button class="btn-bar" id="criarprojeto-btn"><i class="fa-regular fa-plus"></i> Criar Projeto</button>
                            <button class="btn-bar" id="uploadplanilha-btn"><i class="fa-regular fa-upload"></i> Upload de Planilha</button>
                        </div>
                    </div>
                    <div class="docs"></div>
                </div>
            </div>
        </div>
    </div>
</body>


<div class="backgroundOptions" id="UploadPlanilha" style="display: none;">
    <div class="GroundOptions">
        <div class="opts1">
            <h1>Upload de planilha</h1>
            <i class="fa-regular fa-xmark" id="btn-ocultaruploadplanilha"></i>
        </div>
        <div class="opts2">
            <form action="" method="post" enctype="multipart/form-data">
                <h1 for="dados">Insira os Dados aqui!</h1>
                <textarea class="textarea" name="dados" id="dados" rows="10" cols="50"></textarea>
                <input class="input" type="submit" value="Enviar">
            </form>
        </div>
        <div class="opts3">
            <h1>© 2023 PSI Industrial - Todos os direitos reservados.</h1>
            <h1>Desenvolvido por Thaynison Couto</h1>
        </div>
    </div>
</div>

<div class="backgroundOptions" id="CriarPlanilha" style="display: none;">
    <div class="GroundOptions">
        <div class="opts1">
            <h1>Criar novo projeto</h1>
            <i class="fa-regular fa-xmark" id="btn-ocultarcriarplanilha"></i>
        </div>
        <div class="opts2">
        <form class="form" action="" method="post" enctype="multipart/form-data">
            <div class="forms1">
                <div class="dadosform">
                    <h1>Titulo do Projeto:</h1>
                    <input class="inputdads" type="text" name="titulo" id="titulo">
                </div>
                <div class="dadosform">
                    <h1>Documento do Projeto:</h1>
                    <input class="inputdads" type="text" name="documento" id="documento">
                </div>
                <div class="dadosform">
                    <h1>Centro de Custo:</h1>
                    <input class="inputdads" type="text" name="pep" id="pep">
                </div>
                <div class="dadosform">
                    <h1>Valor de Custo:</h1>
                    <input class="inputdads" type="text" name="valor" id="valor">
                </div>
            </div>
            <div class="forms2">
                <div class="dadosform">
                    <h1>Mês do projeto:</h1>
                    <input class="inputdads" type="text" name="mes" id="mes">
                </div>
                <div class="dadosform">
                    <h1>Status do projeto:</h1>
                    <input class="inputdads" type="text" name="status" id="status">
                </div>
                <div class="dadosform">
                    <h1>Responsavel do projeto:</h1>
                    <input class="inputdads" type="text" name="responsavel" id="responsavel">
                </div>
                <div class="dadosform">
                    <input class="btn-send" type="submit" name="criarplanilha" value="Salvar">
                </div>
            </div>
        </form>
        </div>
        <div class="opts3">
            <h1>© 2023 PSI Industrial - Todos os direitos reservados.</h1>
            <h1>Desenvolvido por Thaynison Couto</h1>
        </div>
    </div>
</div>

<script>
    // ============================================= Upload de Planilha
    const btnvew_criarprojeto = document.getElementById('criarprojeto-btn');
    const divUpload_criarprojeto = document.getElementById('CriarPlanilha');
    btnvew_criarprojeto.addEventListener('click', function() {
        divUpload_criarprojeto.style.display = 'block';
    });
    const btnOcultar_ocultarcriarplanilha = document.getElementById('btn-ocultarcriarplanilha');
    const divUpload_CriarPlanilha = document.getElementById('CriarPlanilha');
    btnOcultar_ocultarcriarplanilha.addEventListener('click', function() {
        divUpload_CriarPlanilha.style.display = 'none';
    });
    // ============================================= Upload de Planilha
    const btnvew_uploadplanilha = document.getElementById('uploadplanilha-btn');
    const divUpload_uploadplanilha = document.getElementById('UploadPlanilha');
    btnvew_uploadplanilha.addEventListener('click', function() {
        divUpload_uploadplanilha.style.display = 'block';
    });
    const btnOcultar_ocultaruploadplanilha = document.getElementById('btn-ocultaruploadplanilha');
    const divUpload_ocultaruploadplanilha = document.getElementById('UploadPlanilha');
    btnOcultar_ocultaruploadplanilha.addEventListener('click', function() {
        divUpload_ocultaruploadplanilha.style.display = 'none';
    });
    // =============================================
    var dashboardButton = document.getElementById("dashboard-btn");
    dashboardButton.addEventListener("click", function() {
        window.location.href = "../index.php";
    });
    var documentosButton = document.getElementById("documentos-btn");
    documentosButton.addEventListener("click", function() {
        window.location.href = "../paginas/documentos.php";
    });
    var relatoriosButton = document.getElementById("relatorios-btn");
    relatoriosButton.addEventListener("click", function() {
        window.location.href = "../paginas/relatorios.php";
    });
    var perfilButton = document.getElementById("perfil-btn");
    perfilButton.addEventListener("click", function() {
        window.location.href = "../paginas/perfil.php";
    });
    var configuracoesButton = document.getElementById("configuracoes-btn");
    configuracoesButton.addEventListener("click", function() {
        window.location.href = "../paginas/configuracaoes.php";
    });
    var logoutButton = document.getElementById("logout-btn");
    logoutButton.addEventListener("click", function() {
        window.location.href = "../paginas/logout.php";
    });
    // =============================================
</script>
<script>
    $(document).ready(function() {
        $('.fa-magnifying-glass').on('click', function() {
            var searchText = $('.input').val().toLowerCase();
            
            $('.add5').each(function() {
                var projetoTitulo = $(this).find('.components:nth-child(3)').text().toLowerCase();
                
                if (projetoTitulo.includes(searchText)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>
<script>
    document.addEventListener("click", function(event) {
        if (event.target.classList.contains("view-project")) {
            var projectId = event.target.dataset.projectId;
            togglePlanilha(projectId, "ViewPlanilha");
        }

        if (event.target.classList.contains("edit-project")) {
            var projectIdA = event.target.dataset.projectId;
            togglePlanilha(projectIdA, "EditPlanilha");
        }

        // Check if the clicked element has the class btn-ocultar
        if (event.target.classList.contains("btn-ocultar")) {
            var projectId = event.target.dataset.projectId;
            hidePlanilha(projectId);
        }
    });

    function togglePlanilha(projectId, mode) {
        var planilhaDiv = document.getElementById(mode + "_" + projectId);
        planilhaDiv.style.display = "block";
    }
    
    function hidePlanilha(projectId) {
        var viewPlanilhaDiv = document.getElementById("ViewPlanilha_" + projectId);
        var editPlanilhaDiv = document.getElementById("EditPlanilha_" + projectId);
        viewPlanilhaDiv.style.display = "none";
        editPlanilhaDiv.style.display = "none";
    }
</script>


<?php mysqli_data_seek($result_BuscaProjetos, 0); ?>
<?php while ($row = mysqli_fetch_assoc($result_BuscaProjetos)) { ?>
<div class="backgroundOptions" id="ViewPlanilha_<?php echo $row['id']; ?>" style="display: none;">
    <div class="GroundOptions">
        <div class="opts1">
            <h1>Visualizar projeto</h1>
            <i class="fa-regular fa-xmark btn-ocultar" id="btn-ViewPlanilha" data-project-id="<?php echo $row['id']; ?>"></i>
        </div>
        <div class="opts2">
            <form class="form" action="" method="post" enctype="multipart/form-data">
                <div class="forms1">
                    <div class="dadosform">
                        <h1>Título do Projeto:</h1>
                        <input class="inputdads" type="text" value="<?php echo utf8_encode($row['titulo']); ?>" disabled>
                    </div>
                    <div class="dadosform">
                        <h1>Documento do Projeto:</h1>
                        <input class="inputdads" type="text" value="<?php echo utf8_encode($row['documento']); ?>" disabled>
                    </div>
                    <div class="dadosform">
                        <h1>Centro de Custo:</h1>
                        <input class="inputdads" type="text" value="<?php echo utf8_encode($row['pep']); ?>" disabled>
                    </div>
                    <div class="dadosform">
                        <h1>Valor de Custo:</h1>
                        <input class="inputdads" type="text" value="<?php echo utf8_encode($row['valor']); ?>" disabled>
                    </div>
                </div>
                <div class="forms2">
                    <div class="dadosform">
                        <h1>Mês do projeto:</h1>
                        <input class="inputdads" type="text" value="<?php echo utf8_encode($row['mes']); ?>" disabled>
                    </div>
                    <div class="dadosform">
                        <h1>Status do projeto:</h1>
                        <input class="inputdads" type="text" value="<?php echo utf8_encode($row['status']); ?>" disabled>
                    </div>
                    <div class="dadosform">
                        <h1>Responsável do projeto:</h1>
                        <input class="inputdads" type="text" value="<?php echo utf8_encode($row['responsavel']); ?>" disabled>
                    </div>
                    <div class="dadosform">

                    </div>
                </div>
            </form>
        </div>
        <div class="opts3">
            <h1>© 2023 PSI Industrial - Todos os direitos reservados.</h1>
            <h1>Desenvolvido por Thaynison Couto</h1>
        </div>
    </div>
</div>
<?php } ?>

<?php mysqli_data_seek($result_BuscaProjetos, 0); ?>
<?php while ($row = mysqli_fetch_assoc($result_BuscaProjetos)) { ?>
<div class="backgroundOptions" id="EditPlanilha_<?php echo $row['id']; ?>" style="display: none;">
    <div class="GroundOptions">
        <div class="opts1">
            <h1>Editar projeto</h1>
            <i class="fa-regular fa-xmark btn-ocultar" id="btn-EditPlanilha" data-project-id="<?php echo $row['id']; ?>"></i>
        </div>
        <div class="opts2">
        <form class="form" action="" method="post" enctype="multipart/form-data">
                <div class="forms1">
                    <div class="dadosform">
                        <h1>Título do Projeto:</h1>
                        <input class="inputdads" type="text" name="titulo" value="<?php echo utf8_encode($row['titulo']); ?>">
                        <input class="inputdads" type="hidden" name="id" value="<?php echo utf8_encode($row['id']); ?>">
                    </div>
                    <div class="dadosform">
                        <h1>Documento do Projeto:</h1>
                        <input class="inputdads" type="text" name="documento" value="<?php echo utf8_encode($row['documento']); ?>" disabled>
                    </div>
                    <div class="dadosform">
                        <h1>Centro de Custo:</h1>
                        <input class="inputdads" type="text" name="pep" value="<?php echo utf8_encode($row['pep']); ?>" disabled>
                    </div>
                    <div class="dadosform">
                        <h1>Valor de Custo:</h1>
                        <input class="inputdads" type="text" name="valor" value="<?php echo utf8_encode($row['valor']); ?>" disabled>
                    </div>
                </div>
                <div class="forms2">
                    <div class="dadosform">
                        <h1>Mês do projeto:</h1>
                        <input class="inputdads" type="text" name="mes" value="<?php echo utf8_encode($row['mes']); ?>" disabled>
                    </div>
                    <div class="dadosform">
                        <h1>Status do projeto:</h1>
                        <input class="inputdads" type="text" name="status" value="<?php echo utf8_encode($row['status']); ?>">
                    </div>
                    <div class="dadosform">
                        <h1>Responsável do projeto:</h1>
                        <input class="inputdads" type="text" name="responsavel" value="<?php echo utf8_encode($row['responsavel']); ?>" disabled>
                    </div>
                    <div class="dadosform">
                        <input class="btn-send" type="submit" name="salvaredicao" value="Salvar">
                    </div>
                </div>
            </form>
        </div>
        <div class="opts3">
            <h1>© 2023 PSI Industrial - Todos os direitos reservados.</h1>
            <h1>Desenvolvido por Thaynison Couto</h1>
        </div>
    </div>
</div>
<?php } ?>