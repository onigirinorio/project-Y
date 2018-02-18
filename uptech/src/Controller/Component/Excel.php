<?php
/**
 * Created by PhpStorm.
 * User: joedie
 * Date: 2018/01/28
 * Time: 14:24
 */

namespace App\Controller\Component;
require realpath(__DIR__.'/../../../vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Reader\Xls;
class Excel {
    const EXCEL_TMP_PATH = ROOT.'/webroot/files/prot.xls';

    public $xls;

    public function __construct(){
        $this->xls = new Xls();
        $spreadsheet = $this->xls->load(self::EXCEL_TMP_PATH); // ファイルをロードするとSpreadsheetが得られます。
        var_dump($spreadsheet);
        die();
    }

    public function timeSeat(){
        return $this->xls;
    }


}