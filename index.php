<?php
include 'conexao/conexao.php';

// =====================================================================
$consultores = "SELECT nome FROM consultores";
$result_consultores = $conexao->query($consultores);
// =====================================================================

// =====================================================================
$ProjetosCont = "SELECT COUNT(id) as total FROM projetos";
$result_ProjetosCont = $conexao->query($ProjetosCont);
$rowProjetosCont = $result_ProjetosCont->fetch_assoc();
$totalProjetos = $rowProjetosCont['total'];
// =====================================================================

// =====================================================================
$saldos = "SELECT saldo FROM peps_projetos";
$result_saldos = $conexao->query($saldos);
// =====================================================================

// =====================================================================
$queryProjetos = "SELECT SUM(valor) AS total_valor FROM projetos";
$resultProjetos = mysqli_query($conexao, $queryProjetos);
$rowProjetos = mysqli_fetch_assoc($resultProjetos);
$totalValorProjetos = $rowProjetos['total_valor'];

$queryPepsProjetos = "SELECT SUM(saldo) AS total_saldo FROM peps_projetos";
$resultPepsProjetos = mysqli_query($conexao, $queryPepsProjetos);
$rowPepsProjetos = mysqli_fetch_assoc($resultPepsProjetos);
$totalSaldoPepsProjetos = $rowPepsProjetos['total_saldo'];

$valorRestanteSaldo = $totalSaldoPepsProjetos - $totalValorProjetos;
// =====================================================================

// =====================================================================
$BuscaProjetos = "SELECT titulo, documento, valor, status FROM projetos";
$result_BuscaProjetos = mysqli_query($conexao, $BuscaProjetos );
// =====================================================================

// =====================================================================
$graficoResult = "SELECT mes, SUM(valor) AS valor_total FROM projetos GROUP BY mes ORDER BY mes";
$result_graficoResult = mysqli_query($conexao, $graficoResult);
$ordemMeses = array(
    "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
    "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
);
$dadosGrafico = array(
    'labels' => array(),
    'datasets' => array(
        array(
            'label' => 'Gastos Mensais',
            'data' => array(),
            'backgroundColor' => 'rgba(122, 177, 231, 0.652)',
            'borderColor' => 'rgba(75, 192, 192, 1)',
            'borderWidth' => 1,
            'fill' => true,
        ),
    ),
);
$valoresPorMes = array_fill_keys($ordemMeses, 0);
while ($row = mysqli_fetch_assoc($result_graficoResult)) {
    $mes = $row['mes'];
    $valor_total = $row['valor_total'];
    $valoresPorMes[$mes] = $valor_total;
}
foreach ($ordemMeses as $mes) {
    $dadosGrafico['labels'][] = $mes;
    $dadosGrafico['datasets'][0]['data'][] = $valoresPorMes[$mes];
}
$dadosGraficoJSON = json_encode($dadosGrafico);
// =====================================================================

// =====================================================================
$DadosGraficos1 = "SELECT SUM(valor) AS total_valor FROM projetos";
$resultDadosGraficos1 = mysqli_query($conexao, $DadosGraficos1);
$rowDadosGraficos1 = mysqli_fetch_assoc($resultDadosGraficos1);
$totalDadosGraficos1 = $rowDadosGraficos1['total_valor'];
$DadosGraficos2 = "SELECT SUM(saldo) AS total_saldo FROM peps_projetos";
$resultDadosGraficos2 = mysqli_query($conexao, $DadosGraficos2);
$rowDadosGraficos2 = mysqli_fetch_assoc($resultDadosGraficos2);
$totalDadosGraficos2 = $rowDadosGraficos2['total_saldo'];
$valorRestanteSaldo = $totalDadosGraficos2 - $totalDadosGraficos1;
$labels = array('Saldo Disponível', 'Saldo Gastos', 'Saldo Total');
$data = array($valorRestanteSaldo, $totalDadosGraficos1, $totalDadosGraficos2);
$dadosGrafico3 = array(
    'labels' => $labels,
    'datasets' => array(
        array(
            'data' => $data,
            // 'backgroundColor' => array('rgb(38, 151, 255)', 'rgb(118, 211, 0)', 'rgb(253, 97, 97)'),
            'backgroundColor' => array('rgba(253, 97, 97, 0.652)', 'rgba(118, 211, 0, 0.652)','rgba(38, 151, 255, 0.652)'),
        ),
    ),
);
$dadosGraficoJSON3 = json_encode($dadosGrafico3);

// =====================================================================
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/styles.css">
    <link rel="stylesheet" href="Styles/Deck.css">
    <link rel="stylesheet" href="Styles/Element.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css">
    <link rel="shortcut icon" href="img/psi-logo.png" type="image/x-icon">
    <title>PSI - Planejamento</title>
</head>
<body>
    <div class="hub">
        
        <div class="bar1">
            <div class="deck1"><img src="img/psi-logo.png" alt="logo empresa"></div>
            <div class="deck2">
                <button class="btn-bar" id="dashboard-btn"><i class="fa-regular fa-layer-group"></i> Dashboard</button>
                <button class="btn-bar" id="documentos-btn"><i class="fa-regular fa-table"></i> Administrativo</button>
                <button class="btn-bar" id="relatorios-btn"><i class="fa-regular fa-folder-open"></i> Projetos</button>
                <button class="btn-bar" id="perfil-btn"><i class="fa-regular fa-circle-user"></i> Perfil</button>
                <button class="btn-bar" id="configuracoes-btn"><i class="fa-regular fa-gear"></i> Configurações</button>
            </div>
            <div class="deck3">
                <button class="btn-bar" id="logout-btn"><i class="fa-solid fa-right-from-bracket fa-bounce"></i> Log Out</button>
                
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
                        <?php
                            while ($row = $result_consultores->fetch_assoc()) {
                                $nome = $row['nome'];
                                echo "<option value='$nome'>$nome</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="element2">
                <div class="pag1">
                    <div class="dados1">
                        <div class="avanco">
                            <div class="add">
                            <i class="fa-regular fa-circle-user"></i>
                            <i class="fa-regular fa-list"></i>
                            </div>
                            <div class="add">
                                <h1><?php echo $totalProjetos; ?>°</h1>
                            </div>
                            <div class="add">
                                <h2>Projetos</h2>
                            </div>
                        </div>
                        <div class="avanco">
                            <div class="add">
                                <i class="fa-regular fa-dollar-sign"></i>
                                <i class="fa-regular fa-eye-slash" id="toggleSaldo"></i>
                            </div>
                                <div class="add">
                                <?php
                                    $totalSaldo = 0;
                                    while ($row = $result_saldos->fetch_assoc()) {
                                        $saldo = $row['saldo'];
                                        $totalSaldo += $saldo;
                                    }
                                ?>
                                <h1 id="ViewSaldo">R$ <?php echo number_format($totalSaldo, 2, ',', '.'); ?></h1>
                            </div>
                            <div class="add">
                                <h2>Saldo Total</h2>
                            </div>
                        </div>
                        <div class="avanco">
                        <div class="add">
                            <i class="fa-regular fa-dollar-sign"></i>
                            <i class="fa-regular fa-eye-slash" id="toggleRestante"></i>
                            </div>
                            <div class="add">
                                <h1 id="ViewRestante">R$ <?php echo number_format($valorRestanteSaldo, 2, ',', '.'); ?></h1>
                            </div>
                            <div class="add">
                                <h2>Disponível</h2>
                            </div>
                        </div>
                    </div>
                    <div class="dados2">
                        <div class="avanco">
                            <canvas id="myChart" style="width: 90%; height: 90%;"></canvas>
                        </div>
                    </div>
                    <div class="dados3">

                        <div class="avanco">

                            <div class="add1">
                                <h1>Projetos Recentes</h1>
                                <i class="fa-regular fa-arrows-rotate fa-spin"></i>
                            </div>
                            <div class="add2">
                                <h1 class="components">Documento ID</h1>
                                <h1 class="components">Nome Projeto</h1>
                                <h1 class="components">Status</h1>
                                <h1 class="components">Valor</h1>
                            </div>

                            <div class="add3-container">
                                <?php
                                while ($row = mysqli_fetch_assoc($result_BuscaProjetos)) {
                                    ?>
                                    <div class="add3">
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
                </div>
                <div class="pag2">
                    <div class="dados"> 
                        <div class="avanco1">
                            <h1>Gastos Gerais</h1>
                            <i class="fa-regular fa-ellipsis"></i>
                        </div>
                        <div class="avanco2">
                            <canvas id="myDoughnut" style="width: 90%; height: 90%;"></canvas>
                        </div>
                    </div>
                    <div class="dados">
                        <div class="avanco1">
                            <h1>Análise</h1>
                            <i class="fa-regular fa-ellipsis"></i>
                        </div>
                        <div class="avanco2">
                            <canvas id="myMixed" style="width: 90%; height: 90%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var dadosGrafico = <?php echo $dadosGraficoJSON; ?>;
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: dadosGrafico.labels,
            datasets: dadosGrafico.datasets,
        },
        options: {
            plugins: {
                legend: {
                    labels: {
                        color: 'black', // Define a cor da fonte da legenda
                    },
                },
            },
            scales: {
                x: {
                    display: true,
                    grid: {
                        display: false, // Remover linhas de grade no eixo x
                    },
                    ticks: {
                        color: 'black', // Define a cor dos rótulos do eixo x
                    },
                },
                y: {
                    display: true,
                    grid: {
                        display: false, // Remover linhas de grade no eixo y
                    },
                    ticks: {
                        color: 'black', // Define a cor dos rótulos do eixo y
                    },
                },
            },
        },
    });

    var ctx = document.getElementById('myDoughnut').getContext('2d'); 
    var dadosGrafico = <?php echo $dadosGraficoJSON3; ?>;
    for (var i = 0; i < dadosGrafico.datasets.length; i++) {
        dadosGrafico.datasets[i].borderColor = 'rgba(0, 0, 0, 0)';
    }
    var myDoughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: dadosGrafico,
        options: {
            plugins: {
                legend: {
                    labels: {
                        color: 'black',
                    },
                },
            },
            responsive: true,
            maintainAspectRatio: false,
        }
    });
    

    var dashboardButton = document.getElementById("dashboard-btn");
    dashboardButton.addEventListener("click", function() {
        window.location.href = "index.php";
    });
    var documentosButton = document.getElementById("documentos-btn");
    documentosButton.addEventListener("click", function() {
        window.location.href = "paginas/documentos.php";
    });
    var relatoriosButton = document.getElementById("relatorios-btn");
    relatoriosButton.addEventListener("click", function() {
        window.location.href = "paginas/relatorios.php";
    });
    var perfilButton = document.getElementById("perfil-btn");
    perfilButton.addEventListener("click", function() {
        window.location.href = "paginas/perfil.php";
    });
    var configuracoesButton = document.getElementById("configuracoes-btn");
    configuracoesButton.addEventListener("click", function() {
        window.location.href = "paginas/configuracaoes.php";
    });
    var logoutButton = document.getElementById("logout-btn");
    logoutButton.addEventListener("click", function() {
        window.location.href = "paginas/logout.php";
    });


    document.getElementById('toggleSaldo').addEventListener('click', function() {
        var viewSaldoDiv = document.getElementById('ViewSaldo');

        if (viewSaldoDiv.style.display === 'none') {
            viewSaldoDiv.style.display = 'block';
        } else {
            viewSaldoDiv.style.display = 'none';
        }
    });
    document.getElementById('toggleRestante').addEventListener('click', function() {
        var viewrRestanteDiv = document.getElementById('ViewRestante');

        if (viewrRestanteDiv.style.display === 'none') {
            viewrRestanteDiv.style.display = 'block';
        } else {
            viewrRestanteDiv.style.display = 'none';
        }
    });
</script>
<?php
$conexao->close();
?>



