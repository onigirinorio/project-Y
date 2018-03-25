<?php
echo $this->Form->control('client_name',
    [
        'label' => [
            'text' => 'クライアント名',
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
        'type' => 'number'
    ]
);
echo $this->Form->control('zip_code',
    [
        'label' => [
            'text' => '郵便番号',
            'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
        ],
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input'
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
        'empty' => true,
        'default' => 'empty'
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
