<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Sequencia')
    ->setCellValue('B1', 'Endereço')
    ->setCellValue('C1', 'Codigo')
    ->setCellValue('D1', 'Quantidade')
    ->setCellValue('E1', 'OBS')
    ->setCellValue('F1', 'Nome')
    ->setCellValue('G1', 'IP');

require_once("sql" . DIRECTORY_SEPARATOR . 'Sql.php');

$sql = new Sql();
$data = $sql->select("SELECT * FROM szd");

$i = 2;
foreach($data as $k => $v) {
    $sheet->setCellValue("A{$i}", $v['zd_id'])
        ->setCellValue("B{$i}", $v['zd_end'])
        ->setCellValue("C{$i}", $v['zd_codigo'])
        ->setCellValue("D{$i}", $v['zd_quant'])
        ->setCellValue("E{$i}", $v['zd_obs'])
        ->setCellValue("F{$i}", $v['zd_iden'])
        ->setCellValue("G{$i}", $v['zd_ip']);
    $i++;
}

$nome = 'upload'. DIRECTORY_SEPARATOR . 'export_' . date('d_m_Y') . '.xlsx';

$writer = new Xlsx($spreadsheet);
$writer->save($nome);

header('Location:' . $nome);
die();
?>