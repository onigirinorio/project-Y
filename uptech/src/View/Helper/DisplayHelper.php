<?php
// 各Viewでデータ等を表示する際のフォーマット系ヘルパー

namespace App\View\Helper;
use Cake\View\Helper;

class DisplayHelper extends Helper {
    public function zip_code($number) {
        $number = (string)$number;
        $zip_code = substr($number, 0, 3) . '-' . substr($number, 3, 4);
        return $zip_code;
    }
}
