<?php
echo $this->Form->control('name',
    [
        'label' => [
            'text' => '名前',
            'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
        ],
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
    ]
);
echo $this->Form->control('name_kana',
    [
        'label' => [
            'text' => '名前(カナ)',
            'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
        ],
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
    ]
);
echo $this->Form->control('password',
    [
        'label' => [
            'text' => 'パスワード',
            'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
        ],
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input'
    ]
);

echo $this->Form->control('email',
    [
        'label' => [
            'text' => 'メールアドレス',
            'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
        ],
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
    ]
);
echo $this->Form->control('tell',
    [
        'label' => [
            'text' => '電話番号',
            'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
        ],
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
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
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
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
    ]
);
echo $this->Form->control('project_id',
    [
        'label' => [
            'text' => 'プロジェクト',
            'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
        ],
        'type' => 'select',
        'options' => $project_list,
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
        'empty' => true,
        'default' => 'empty'
    ]
);
