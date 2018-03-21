<?php
// カードコンポーネント

namespace App\View\Helper;
use Cake\View\Helper;

class CardHelper extends Helper {
    public function card($icon, $title) {
        return '<div class="card">
                    <span class="glyphicon glyphicon-' . $icon . ' card-icon text-center" aria-hidden="true"></span>
                    <div class="card-content">
                        <h1 class="card-title">' . $title . '</h1>
                    </div>
                </div>';
    }
}
