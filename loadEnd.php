<?php
    include_once('sql/Sql.php');

    $sql = new Sql();

    $ende = filter_input(INPUT_GET, "zb_end");

    if(!empty($ende)){

        $ende = "%".$ende."%";
        $info = $sql->select('SELECT zb_id, zb_end FROM prd_p12.szb WHERE zb_end LIKE :zb_end LIMIT 5', array(
            ':zb_end' => $ende
        ));
        if(empty($info) and count($info) == 0){
            $retorna = ['erro' => true, 'msg' => "Endereco nao encontrado"];
        }else{
            $retorna = ['erro' => false, 'dados' => $info];
        }
    }else{
        $retorna = ['erro' => true, 'msg' => "Endereco nao encontrado"];
    }

    echo json_encode($retorna);
?>