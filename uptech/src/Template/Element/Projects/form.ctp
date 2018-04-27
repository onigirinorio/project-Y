<?php
echo $this->Form->control('shop_name',
    [
        'label' => [
            'text' => '店舗名',
            'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
        ],
        'placeholder' => '例）ビッグカメラ白金台',
        'maxlength' => '50',
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
    ]
);
echo $this->Form->control('client_id',
    [
        'label' => [
            'text' => 'クライアント名',
            'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
        ],
        'type' => 'select',
        'options' => $clientList,
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
    ]
);
echo $this->Form->control('payment_status',
    [
        'label' => [
            'text' => '支払区分',
            'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
        ],
        'type' => 'select',
        'options' => PAYMENT_STATUS,
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input'
    ]
);

echo $this->Form->control('price',
    [
        'label' => [
            'text' => '金額',
            'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
        ],
        'placeholder' => '例）1900',
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
    ]
);

echo $this->Form->control('in_minutes',
    [
        'label' => [
            'text' => '分単位',
            'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
        ],
        'type' => 'select',
        'options' => IN_MINUTES,
        'default' => 2,
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input'
    ]
);

echo '<label class="col-md-2 col-sm-2 col-xs-12 form_label">交通費有無</label><div class="col-md-10 col-sm-10 col-xs-12 form_radio">';
echo $this->Form->control('expense_status',
    [
        'label' => false,
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_checkbox',
        'style' => 'margin-bottom: 20px;',
    ]
);
echo '</div>';

