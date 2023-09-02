<?php
ob_start();
include '../conexao/conexao.php';

mysqli_set_charset($conexao, 'utf8');

$BuscarMaterial = "SELECT * FROM lista_materiais";
$result_BuscarMaterial = mysqli_query($conexao, $BuscarMaterial );

if (isset($_POST['CadastrarMaterialNovo'])) {
    $nome_material = $_POST['nome_material'];
    $quantidade_material = $_POST['quantidade_material'];
    $valor_material = $_POST['valor_material'];
    $codigo_material = $_POST['codigo_material'];

    // Save the image in a predefined folder
    $target_dir = "img/Materiais/";
    
    // Create the directory if it does not exist
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($_FILES["foto_material"]["name"]);
    move_uploaded_file($_FILES["foto_material"]["tmp_name"], $target_file);

    // Change the name of the image to '$codigo_material.png'
    $new_image_name = $codigo_material . '.png';
    rename($target_file, $target_dir . $new_image_name);

    // Save the image URL in the database
    $foto_material = $target_dir . $new_image_name;

    mysqli_set_charset($conexao, 'utf8');
    
    // Check if the material already exists in the database
    $check_query = "SELECT * FROM lista_materiais WHERE codigo_material='$codigo_material' OR foto_material='$foto_material'";
    $check_result = mysqli_query($conexao, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        echo "O material já existe no banco de dados";
    } else {
        // Insert the new material into the database
        $Criar_Material = "INSERT INTO lista_materiais (codigo_material, nome_material, foto_material, quantidade_material, valor_material) VALUES ( '$codigo_material', '$nome_material', '$foto_material', '$quantidade_material', '$valor_material')";
        $Update_Criar_Material = mysqli_query($conexao, $Criar_Material);

        if ($Update_Criar_Material) {
            header("Location: documentos.php");
            exit();
        } else {
            echo "Erro ao atualizar os dados";
        }
    }
};
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
    <script src="../scripts/quagga.min.js"></script>
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
                <div class="title"><h1>Dashboard</h1></div>
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
                <div class="pag6">
                    <div class="docs">
                        <div class="deck4">
                            <h1>Administrativo</h1>
                            <i class="fa-regular fa-thumbtack"></i>
                        </div>
                        <div class="deck5">
                            <button class="btn-bar" id="criarcliente-btn"><i class="fa-regular fa-plus"></i> Cadastrar Cliente</button>
                            <button class="btn-bar" id="criarorcamento-btn"><i class="fa-regular fa-plus"></i></i> Novo Orçamento</button>
                            <button class="btn-bar" id="admitircolaborador-btn"><i class="fa-regular fa-plus"></i> Admitir Colaborador</button>
                            <button class="btn-bar" id="criarcarteirinha-btn"><i class="fa-regular fa-plus"></i> Criar Carteirinha</button>
                        </div>
                    </div>
                    <div class="docs">
                    <div class="deck4">
                            <h1>Almoxarifado</h1>
                            <i class="fa-regular fa-thumbtack"></i>
                        </div>
                        <div class="deck5">
                            <button class="btn-bar" id="criarmaterial-btn"><i class="fa-regular fa-plus"></i> Cadastrar Material</button>
                            <button class="btn-bar" id="entradamaterial-btn"><i class="fa-regular fa-plus"></i> Romaneio de Entrada</button>                            
                            <button class="btn-bar" id="entradamaterial-btn"><i class="fa-regular fa-plus"></i> Entrada de Material</button>
                            <button class="btn-bar" id="saidamaterial-btn"><i class="fa-regular fa-plus"></i> Saida de Material</button>
                            <button class="btn-bar" id="listadematerial-btn"><i class="fa-regular fa-plus"></i> Lista de Material</button>
                            <button class="btn-bar" id="listadesaidamaterial-btn"><i class="fa-regular fa-plus"></i> Lista de Saida de Material</button>
                        </div>
                    </div>
                </div>
                <div class="pag6" style="display: none;">
                    <div class="docs"></div>
                    <div class="docs"></div>
                </div>
                <div class="pag6" style="display: none;">
                    <div class="docs"></div>
                    <div class="docs"></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
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
</script>

<div class="backgroundOptions" id="CadastrarMaterial" style="display: none;">
    <div class="GroundOptions">
        <div class="opts1">
            <h1>Criar novo material</h1>
            <i class="fa-regular fa-xmark" id="btn-ocultar-CadastrarMaterial"></i>
        </div>
        <div class="opts2">
        <form class="form" action="" method="post" enctype="multipart/form-data">
            <div class="forms1">
                <div class="dadosform">
                    <h1>Nome do Material:</h1>
                    <input class="inputdads" type="text" name="nome_material" id="nome_material">
                </div>
                <div class="dadosform">
                    <h1>Quantidade:</h1>
                    <input class="inputdads" type="text" name="quantidade_material" id="quantidade_material">
                </div>
                <div class="dadosform">
                    <h1>Valor unitário:</h1>
                    <input class="inputdads" type="text" name="valor_material" id="valor_material">
                </div>
                <div class="dadosform">
                    <h1>Foto do Material</h1>
                    <input class="inputdads" type="file" accept="image/*" name="foto_material" id="foto_material">
                </div>
            </div>
            <div class="forms2">
                <div class="dadosform">
                    <!-- <h1>Codigo do Material:</h1> -->
                    <input class="inputdads" type="hidden" name="codigo_material" id="codigo_material">
                </div>
                <div class="dadosform">
                    <!-- <h1>Status do projeto:</h1> -->
                    <!-- <input class="inputdads" type="text" name="status" id="status"> -->
                </div>
                <div class="dadosform">
                    <!-- <h1>Responsavel do projeto:</h1> -->
                    <!-- <input class="inputdads" type="text" name="responsavel" id="responsavel"> -->
                </div>
                <div class="dadosform">
                    <input class="btn-send" type="submit" name="CadastrarMaterialNovo" value="Salvar">
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

<div class="backgroundOptions" id="ListadeMaterial" style="display: none;">
<div class="GroundOptions">
        <div class="opts1">
            <h1>Lista de Materiais</h1>
            <div class="busca1">
                <input class="input" type="text" id="searchInput">
                <i class="fa-regular fa-magnifying-glass pesquisar-material" id="searchButton"></i>
            </div>
            <i class="fa-regular fa-xmark" id="btn-ocultar-ListadeMaterial"></i>
        </div>
        <div class="opts2">
            <div class="add4">
                <h1 class="components"></h1>
                <h1 class="components">COD</h1>
                <h1 class="components">Material</h1>
                <h1 class="components">Quantidade</h1>
                <h1 class="components">Valor Unitário</h1>
            </div>
            <div class="add5-container">
                <?php
                while ($row = mysqli_fetch_assoc($result_BuscarMaterial)) {?>
                    <div class="add5 material-item">
                        <h1 class="components" style="font-size: 15px; display: flex; justify-content: space-evenly; align-items: center;">
                            <img class="componentsimg" src="<?php echo ($row['foto_material']); ?>" alt="">
                        </h1>
                        <h1 class="components">#<?php echo utf8_encode($row['codigo_material']); ?></h1>
                        <h1 class="components"><?php echo utf8_encode($row['nome_material']); ?></h1>
                        <h1 class="components"><?php echo utf8_encode($row['quantidade_material']); ?></h1>
                        <h1 class="components">R$ <?php echo utf8_encode($row['valor_material']); ?></h1>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="opts3">
            <h1>© 2023 PSI Industrial - Todos os direitos reservados.</h1>
            <h1>Desenvolvido por Thaynison Couto</h1>
        </div>
    </div>
</div>

<img src="">
<div class="backgroundOptions" id="SaidaMaterial" style="display: none;">
    <div class="GroundOptions">
        <div class="opts1">
            <h1>Saida de material</h1>
            <i class="fa-regular fa-xmark" id="btn-ocultar-SaidaMaterial"></i>
        </div>
        <div class="opts2">
            <form class="form" action="" method="post" enctype="multipart/form-data">
                <div class="forms1">
                    <div class="dadosform">
                        <h1>Material:</h1>
                        <select class="inputdads" name="codigo_material">
                            <?php
                            $consultaMateriais = "SELECT codigo_material, nome_material, foto_material FROM lista_materiais";
                            $result_consultaMateriais = $conexao->query($consultaMateriais);

                            while ($row = $result_consultaMateriais->fetch_assoc()) {
                                $nome_material = $row['nome_material'];
                                $codigo_material = $row['codigo_material'];
                                echo "<option value='$codigo_material'>$nome_material</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="dadosform">
                        <h1>Quantidade:</h1>
                        <input class="inputdads" type="text" name="quantidade_material" id="quantidade_material">
                    </div>
                    <div class="dadosform">

                    </div>
                    <div class="dadosform">
                        <div id="camera"></div>
                        <input id="resultado" disabled>
                        <input id="resultado" class="resultado" type="hidden" name="codigo_colaborador">
                    </div>
                </div>
                <div class="forms2">
                    <div class="dadosform">

                    </div>
                    <div class="dadosform">

                    </div>
                    <div class="dadosform">

                    </div>
                    <div class="dadosform">
                        <input class="btn-send" type="submit" name="SalvarSaidaMaterial" value="Salvar">
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
    document.getElementById("listadematerial-btn").addEventListener("click", function() {
        document.getElementById("ListadeMaterial").style.display = "block";
    });
    document.getElementById("btn-ocultar-ListadeMaterial").addEventListener("click", function() {
        document.getElementById("ListadeMaterial").style.display = "none";
    });
    document.getElementById("criarmaterial-btn").addEventListener("click", function() {
        document.getElementById("CadastrarMaterial").style.display = "block";
    });
    document.getElementById("btn-ocultar-CadastrarMaterial").addEventListener("click", function() {
        document.getElementById("CadastrarMaterial").style.display = "none";
    });
    function gerarNumerosAleatoriosUnicos() {
        var numeros = [];
        while(numeros.length < 6) {
            var numero = Math.floor(Math.random() * 10);
            if(numeros.indexOf(numero) === -1) numeros.push(numero);
        }
        return numeros.join('');
    }
    document.getElementById("codigo_material").value = gerarNumerosAleatoriosUnicos();
</script>
<script>
    $(document).ready(function() {
        $('#searchButton').click(function() {
            var searchText = $('#searchInput').val().toLowerCase();
            $('.material-item').each(function() {
                var materialName = $(this).find('.components:eq(2)').text().toLowerCase();
                var materialCode = $(this).find('.components:eq(1)').text().toLowerCase();
                if (materialName.includes(searchText) || materialCode.includes(searchText)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>
<script>
    document.getElementById("saidamaterial-btn").addEventListener("click", function() {
        document.getElementById("SaidaMaterial").style.display = "block";
        startCamera();
    });

    document.getElementById("btn-ocultar-SaidaMaterial").addEventListener("click", function() {
        document.getElementById("SaidaMaterial").style.display = "none";
        stopCamera();
    });

    let isCameraActive = false;

    function startCamera() {
        if (!isCameraActive) {
            Quagga.init({
                inputStream: {
                    name: "Live",
                    type: "LiveStream",
                    target: document.querySelector('#camera')
                },
                decoder: {
                    readers: ["code_128_reader"]
                }
            }, function (err) {
                if (err) {
                    console.log(err);
                    return;
                }
                console.log("Initialization finished. Ready to start");
                Quagga.start();
                isCameraActive = true;
            });

            Quagga.onDetected(function (data) {
                document.querySelector('#resultado').value = data.codeResult.code;
                document.querySelector('.resultado').value = data.codeResult.code;
                NumeroColab = data.codeResult.code
                console.log(NumeroColab);

            });
        }
    }

    function stopCamera() {
        if (isCameraActive) {
            Quagga.stop();
            isCameraActive = false;
        }
    }
</script>



<?php
if (isset($_POST['SalvarSaidaMaterial'])) {
    // Dados do formulário
    $codigo_material = $_POST['codigo_material']; // Código do material selecionado
    $quantidade_saida = $_POST['quantidade_material'];
    $codigo_colaborador = $_POST['codigo_colaborador'];

    // Consulta para obter o nome do material com base no código selecionado
    $consultaNomeMaterial = "SELECT nome_material, quantidade_material FROM lista_materiais WHERE codigo_material = '$codigo_material'";
    $resultadoNomeMaterial = $conexao->query($consultaNomeMaterial);

    if ($resultadoNomeMaterial->num_rows > 0) {
        $row = $resultadoNomeMaterial->fetch_assoc();
        $nome_material = $row['nome_material'];
        $quantidade_material_atual = $row['quantidade_material'];

        // Verifique se há material suficiente disponível para a saída
        if ($quantidade_saida <= $quantidade_material_atual) {
            // Calcule a nova quantidade de material após a saída
            $nova_quantidade_material = $quantidade_material_atual - $quantidade_saida;

            // Atualize a quantidade de material na tabela 'lista_materiais'
            $atualizarQuantidadeQuery = "UPDATE lista_materiais SET quantidade_material = '$nova_quantidade_material' WHERE codigo_material = '$codigo_material'";

            // Execute a query de atualização
            if ($conexao->query($atualizarQuantidadeQuery) === TRUE) {
                // Query para inserir os dados na tabela 'saida_material'
                $inserirSaidaQuery = "INSERT INTO saida_material (codigo_material, nome_material, quantidade_saida, codigo_colaborador) 
                                        VALUES ('$codigo_material', '$nome_material', '$quantidade_saida', '$codigo_colaborador')";

                // Execute a query de inserção na tabela 'saida_material'
                if ($conexao->query($inserirSaidaQuery) === TRUE) {
                    echo "dados adicionados ao banco dados";
                    header("Location: documentos.php");
                    exit();
                } else {
                    echo "Erro ao inserir dados na tabela de saída de material: " . $conexao->error;
                }
            } else {
                echo "Erro ao atualizar a quantidade de material: " . $conexao->error;
            }
        } else {
            echo "Quantidade de material insuficiente para a saída.";
        }
    } else {
        echo "Material não encontrado.";
    }
}


mysqli_close($conexao);
ob_end_flush();
?>