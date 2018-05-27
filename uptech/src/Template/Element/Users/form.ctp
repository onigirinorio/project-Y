<?php
echo $this->Form->control('name',
    [
        'label' => [
            'text' => '名前',
            'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
        ],
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
        'maxlength' => '36',
        'placeholder' => '例）田中太郎',
    ]
);
echo $this->Form->control('name_kana',
    [
        'label' => [
            'text' => '名前（カナ）',
            'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
        ],
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
        'maxlength' => '36',
        'placeholder' => '例）タナカタロウ',
    ]
);
echo $this->Form->control('password',
    [
        'label' => [
            'text' => 'パスワード',
            'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
        ],
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
        'placeholder' => '半角英数字８文字以上１６文字以下で入力してください。',
        'minlength' => '8',
        'maxlength' => '16',
    ]
);
echo $this->Form->control('password_check',
    [
        'label' => [
            'text' => 'パスワード(確認用)',
            'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
        ],
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
        'placeholder' => '半角英数字８文字以上１６文字以下で入力してください。',
        'minlength' => '8',
        'maxlength' => '16',
        'type' => 'password',
    ]
);
echo $this->Form->control('email',
    [
        'label' => [
            'text' => 'メールアドレス',
            'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
        ],
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
        'maxlength' => '256',
        'placeholder' => '例）test@test.com',
    ]
);
echo $this->Form->control('tell',
    [
        'label' => [
            'text' => '電話番号',
            'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
        ],
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
        'maxlength' => '11',
        'placeholder' => '例）00011112222',
    ]
);
echo '<label class="col-md-2 col-sm-2 col-xs-12 form_label">性別</label><div class="col-md-10 col-sm-10 col-xs-12 form_radio" data-toggle="buttons">';
if (empty($user->gender)) {
    $val = 0;
} else {
    $val = 1;
}
foreach (GENDER as $key => $gender) {
    echo $this->Form->radio('gender',
        [$key => $gender]
        , ['value' => $val]
    );
}
echo '</div>';

echo '<label class="col-md-2 col-sm-2 col-xs-12 form_label">生年月日</label><div class="col-md-10 col-sm-10 col-xs-12 form_date_select">';
echo $this->Form->control('birth',
    [
        'label' => false,
        'empty' => false,
        'monthNames' => false,
        'maxYear' => date('Y'),
        'minYear' => date('Y') - 40,
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
        'style' => 'margin-bottom: 20px;height:34px;',
        'default' => date('2000-1-1'),
    ]
);
echo '</div>';

echo $this->Form->control('zip_code',
    [
        'label' => [
            'text' => '郵便番号',
            'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
        ],
        'type' => 'text',
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
        'maxlength' => 7,
        'placeholder' => '例）1234567'
    ]
);
echo $this->Form->control('pref',
    [
        'label' => [
            'text' => '都道府県',
            'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
        ],
        'type' => 'select',
        'options' => PREF,
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
    ]
);
echo $this->Form->control('address',
    [
        'label' => [
            'text' => '都道府県以降',
            'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
        ],
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
        'placeholder' => '例）札幌市北海道ビル１０１',
    ]
);

echo '<label class="col-md-2 col-sm-2 col-xs-12 form_label">開始日</label><div class="col-md-10 col-sm-10 col-xs-12 form_date_select">';
echo $this->Form->control('start_date',
    [
        'type' => 'date',
        'label' => false,
        'empty' => false,
        'monthNames' => false,
        'maxYear' => date('Y') + 5,
        'minYear' => date('Y') - 5,
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
        'style' => 'margin-bottom: 20px;height:34px;',
    ]
);
echo '</div>';

echo '<label class="col-md-2 col-sm-2 col-xs-12 form_label">終了日</label><div class="col-md-10 col-sm-10 col-xs-12 form_date_select">';
echo $this->Form->control('end_date',
    [
        'type' => 'date',
        'label' => false,
        'empty' => false,
        'monthNames' => false,
        'maxYear' => date('Y') + 5,
        'minYear' => date('Y') - 5,
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
        'style' => 'margin-bottom: 20px;height:34px;',
    ]
);
echo '</div>';

echo $this->Form->control('expense_route',
    [
        'label' => [
            'text' => '交通経路',
            'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
        ],
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
        'maxlength' => '126',
        'placeholder' => '例）渋谷-白金台　※ハイフンは半角を使用してください',
    ]
);

echo $this->Form->control('expense_price',
    [
        'label' => [
            'text' => '交通費',
            'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
        ],
        'placeholder' => '例）15000',
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
    ]
);

echo $this->Form->control('project_id',
    [
        'label' => [
            'text' => '案件名',
            'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
        ],
        'type' => 'select',
        'options' => $project_list,
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
        'empty' => true,
        'default' => 'empty'
    ]
);

echo $this->Form->control('work_location',
    [
        'label' => [
            'text' => '勤務先',
            'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
        ],
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
        'maxlength' => '126',
        'placeholder' => '例）ソフトバンクショップ渋谷店',
    ]
);
