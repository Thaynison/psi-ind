<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/styles.css">
    <link rel="stylesheet" href="../Styles/Deck.css">
    <link rel="stylesheet" href="../Styles/Element.css">
    <link rel="stylesheet" href="../Styles/relatorios.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css">
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
</script>