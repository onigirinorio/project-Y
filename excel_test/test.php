<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$name = 'テスト太郎';
$xlsxFilepath = 'prot.xls';
$reader = new PhpOffice\PhpSpreadsheet\Reader\Xls();
$spreadsheet = $reader->load($xlsxFilepath); // ファイルをロードするとSpreadsheetが得られます。
$sheet = $spreadsheet->getSheet(0); // 最初のシートを得ています。Sheetが得られます。
$rowArray = $sheet->toArray(); // これで表の2次元配列が得られます。
$rowArray[0][6] = date('m');
$rowArray[0][0] = date('Y');
$rowArray[0][21] = $name;
$rowArray[3][2] = 'aaa';
$last_date = date('t');
for ($i = 1; $i <=31;$i++){
    $a = 2;
    $a = $i+$a;
    var_dump($rowArray[$a]);
    if(){

    }
    $rowArray[$a][2] = 'aaa';
}
$sheet->fromArray($rowArray); // 表の左上（A1）から2次元配列でべたっと貼り付ける例。
$week = array( "日", "月", "火", "水", "木", "金", "土" );
$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);
$writer->save('edit.xls'); // これで保存されます。
//var_dump($rowArray[0]);