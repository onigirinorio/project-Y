<?php

/* ユーザーを変更できる必要ないのでラベルのみに
echo $this->Form->control('user_id',
    [
        'label' => [
            'text' => '名前',
            'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
        ],
        'options' => $users,
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
    ]
);
*/

echo '<label class="col-md-2 col-sm-2 col-xs-12 form_label">日付</label><div class="col-md-10 col-sm-10 col-xs-12 form_radio">';
echo $this->Form->control('date',
    [
        'label' => false,
        'empty' => false,
        'monthNames' => false,
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
        'style' => 'margin-bottom: 20px;height:34px;',
        'default' => date('Y-m-d', strtotime('+1 day'))
    ]
);
echo '</div>';

echo '<label class="col-md-2 col-sm-2 col-xs-12 form_label">ユーザー</label><div class="col-md-10 col-sm-10 col-xs-12 form_radio">';
echo $shift->has('user') ? $shift->user->name : $user_name;
echo $this->Form->hidden('user_id',
    [
        'value' => $shift->has('user') ? $shift->user->user_id : $user_id,
    ]
);
echo '</div>';

echo '<label class="col-md-2 col-sm-2 col-xs-12 form_label">出勤時間</label><div class="col-md-10 col-sm-10 col-xs-12 form_radio">';
echo $this->Form->control('attend',
    [
        'label' => false,
        'empty' => false,
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
        'style' => 'margin-bottom: 20px;height:34px;',
        'default' => '10:00',
    ]
);
echo '</div>';

echo '<label class="col-md-2 col-sm-2 col-xs-12 form_label">退勤時間</label><div class="col-md-10 col-sm-10 col-xs-12 form_radio">';
echo $this->Form->control('clock',
    [
        'label' => false,
        'empty' => false,
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
        'style' => 'margin-bottom: 20px;height:34px;',
        'default' => '19:00'
    ]
);
echo '</div>';

echo '<label class="col-md-2 col-sm-2 col-xs-12 form_label">休日出勤フラグ</label><div class="col-md-10 col-sm-10 col-xs-12 form_radio">';
echo $this->Form->control('holiday_flag',
    [
        'label' => false,
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_checkbox',
        'style' => 'margin-bottom: 20px;',
    ]
);
echo '</div>';
