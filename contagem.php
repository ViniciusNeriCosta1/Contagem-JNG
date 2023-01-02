<?php
    date_default_timezone_set('America/Sao_Paulo');
    include_once('sql/Sql.php');

    $sql = new Sql();

    if(isset($_POST['submit']))
    {
        $zd_iden = $_POST['zd_iden'];
        $zd_codigo = $_POST['zd_codigo'];
        $zd_quant = $_POST['zd_quant'];
        $zd_end = $_POST['zd_end'];
        $zd_obs = $_POST['zd_obs'];

        $result = $sql->query('INSERT INTO prd_p12.szd(
            zd_iden, zd_codigo, zd_quant, zd_end, zd_obs, zd_ip
        ) VALUES (
            :zd_iden, :zd_codigo, :zd_quant, :zd_end, :zd_obs, :zd_ip
        )
        ', array(
        ':zd_iden' => $zd_iden,
        ':zd_codigo' => $zd_codigo,
        ':zd_quant' => $zd_quant,
        ':zd_end' => $zd_end,
        ':zd_obs' => $zd_obs,
        ':zd_ip' => $_SERVER['REMOTE_ADDR']
        ));
        if(! $result){//valida se o resultado do array e informa o erro do insert
            $erros = $sql->getErrors();
            var_dump($erros);
            echo "<script>alert($erros);</script>";
        }else{
            header('Location: contagem.php');
            die();
        }
    }

    $result = $sql->select("SELECT zd_id, zd_iden, zd_codigo, zd_quant, zd_end, zd_obs, zd_ip FROM prd_p12.szd ORDER BY zd_id DESC LIMIT 5");
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
                <a href="./Pesquisa.php">Pesquisa</a>
            </div>    
        </div>
    </header>
    <main>
        <div class="fundo_dados">
            <form action="contagem.php" method="POST">
                    <fieldset>
                        <legend><b>Contagem</b></legend>
                        <div class="inputBox">
                        <label for="zd_iden" class="labelSelect">Nome</label>
                            <input type="text" name="zd_iden" id="zd_iden" class="inputUser" maxlength="6" min="0">
                        </div>
                        <br>
                        <div class="inputBox">
                        <label for="zd_codigo" class="labelSelect">Codigo</label>
                            <input type="number" name="zd_codigo" id="zd_codigo" class="inputUser" maxlength="6" min="0">
                        </div>
                        <br>
                        <div class="inputBox">
                        <label for="zd_quant" class="labelSelect">Quantidade</label>
                            <input type="number" name="zd_quant" id="zd_quant" class="inputUser" required maxlength="6" min="0">
                        </div>
                        <br>
                        <div class="inputSelect">
                            <label for="zd_end" class="labelSelect">Endereço</label>
                            <input type="text" name="zd_end" id="zd_end" class="inputUser" onkeyup="listEnd(this.value)">
                            <span id="resultado_pesquisa"></span>
                            <input type="hidden" name="id_ende" id="id_ende" class="inputUser">
                        </div>
                        <br>
                        <div class="inputBox">
                        <label for="zd_obs" class="labelSelect">OBS</label>
                            <input type="text" name="zd_obs" id="zd_obs" class="inputUser">
                        </div>
                        <br>
                        <input type="submit" name="submit" id="submit">
                        <br>
                    </fieldset>
            </form>
        </div>
        <div class="fundo_table">
        <fieldset>
            <legend><b>Ultimos 5</b></legend>
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