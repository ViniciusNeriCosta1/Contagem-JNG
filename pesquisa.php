<?php
    date_default_timezone_set('America/Sao_Paulo');
    include_once('sql/Sql.php');

    $sql = new Sql();

    $result = $sql->select("SELECT zd_id, zd_iden, zd_codigo, zd_quant, zd_end, zd_obs, zd_ip FROM prd_p12.szd ORDER BY zd_id DESC LIMIT 20");

?>

<!DOCTYPE html>
<html lang="pt-br">
    <link rel="stylesheet" href="./assets/style_cel.css">
    <link rel="shortcut icon" type = "imagem/x-icon" href = "./assets/logo_jng.ico"/>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="300">
    <script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>
    <script src="https://kit.fontawesome.com/dadbdef077.js" crossorigin="anonymous"></script>
    <title>Contagem | JNG</title>
</head>
<body>
    <header>
        <div class="logo_header">
            <img src="./assets/logo_JNG_azul.png" alt="Logo JNG" class="img_logo_header">
        </div>
        <div class="header-content">
            <div class="navbar">
                <a href="./contagem.php">Inicio</a>
                <a href="./planilha.php">Planilha</a>
                <a href="./pesquisa.php">Pesquisa</a>
            </div>    
        </div>
    </header>
    <main>
        <div class="fundo_table">
            <fieldset>
                <legend><b>Ultimos 20</b></legend>
                <table>
                    <thead>
                        <tr>
                        <th>Seq</th>
                        <th>Nome</th>
                        <th>End</th>
                        <th>Cod</th></th>
                        <th>Quant</th>
                        <th>OBS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($result as $k => $v){
                                echo"<tr>";
                                echo"<td>".$v['zd_id']."</td>";
                                echo"<td>".$v['zd_iden']."</td>";
                                echo"<td>".$v['zd_end']."</td>";
                                echo"<td>".$v['zd_codigo']."</td>";
                                echo"<td>".$v['zd_quant']."</td>";
                                echo"<td>".$v['zd_obs']."</td>";
                                echo"</tr>";
                            }
                        ?>    
                    </tbody>
                </table>
            </fieldset>
        </div>
    </main>
    <footer>
        <div class="rodape">
            <p>Copyright © 2022 Intranet JNG</p>
        </div>
    </footer>
    <script src="./js/listEnd.js"></script>
    <script src="./js/maxTam.js"></script>
</body>
</html>