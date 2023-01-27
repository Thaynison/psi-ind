<?php

session_start();

include('../conexao/conexao.php');

$html = "";

$sql = "SELECT * FROM cracha ORDER BY nome ASC";
$result = $connec->query($sql);
while($row = $result->fetch_assoc()) {
    echo "
    <head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD' crossorigin='anonymous'>
    <link rel='canonical' href='https://getbootstrap.com/docs/5.3/examples/headers/'>
    <link rel='stylesheet' href='../styles/global.css'>
    <link href='https://media.discordapp.net/attachments/1043295133396910172/1065036673865502731/logo.png' rel='icon' width='10' height='10'>
    <title>PSI - PDF</title>
    </head>
    <body>
        <main>
            <section class='buttonsitens'>
                <div class='sectiondados'>
                <img class='backgroud' src='../images/backgroud.jpg'>

                    <div class='dadosapp'>
                        <div class='img'>
                            <img src='$row[caminho_imagem]'>
                        </div>
                        <div class='dadosimpor'>
                            <article class='bord'>Nome: $row[nome]</article>
                            <article class='bord'>ASO - Venc: $row[aso]</article>
                            <article class='bord'>Função: $row[funcao]</article>
                            <article class='bord'>Empresa: $row[empresa]</article>
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
                                <article>LT - Venc: $row[liberacao]</article>
                                <article>OTQ - Venc: $row[otq]</article>
                                <article>Trab. a Quent - Venc: $row[taq]</article>
                                <article>NR 10 - Venc: $row[nr10]</article>
                                <article>NR 33 - Venc: $row[nr33]</article>
                                <article>NR 35 - Venc: $row[nr35]</article>
                                <article>Talha Manu - Venc: $row[talha]</article>
                                <article>PTA - Venc: $row[pta]</article>
                                <article>Empilhadeira - Venc: $row[empilhadeira]</article>
                                <article>Pictograma - Venc: $row[pictograma]</article>
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
    ";
}

// require '../vendor/autoload.php';

// use Dompdf\Dompdf;

// $dompdf = new Dompdf();

// $dompdf->loadHtml('');

// $dompdf->setPaper('A4', 'portrait',);

// $dompdf->render();

// $dompdf->stream("cracha.pdf", [
//     "Attachment" => false
// ]);


// <td>$row[id]</td>
// <td>$row[nome]</td>
// <td>$row[aso]</td>
// <td>$row[funcao]</td>
// <td>$row[empresa]</td>
// <td>$row[liberacao]</td>
// <td>$row[otq]</td>
// <td>$row[taq]</td>
// <td>$row[nr10]</td>
// <td>$row[nr33]</td>
// <td>$row[nr35]</td>
// <td>$row[talha]</td>
// <td>$row[pta]</td>
// <td>$row[empilhadeira]</td>
// <td>$row[pictograma]</td>