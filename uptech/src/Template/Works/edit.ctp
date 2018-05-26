<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="shifts form large-9 medium-8 columns content">
    <?= $this->Form->create($work) ?>
    <h3 class="h3_responsive"><?= __('勤怠データ編集') ?></h3>

    <?php
    echo '<label class="col-md-2 col-sm-2 col-xs-12 form_label">日付</label><div class="col-md-10 col-sm-10 col-xs-12 form_radio">';
    echo date('Y/m/d', strtotime($work->create_at));
    echo $this->Form->hidden('create_at',
        [
            'value' => $work->create_at,
        ]
    );
    echo '</div>';

    echo '<label class="col-md-2 col-sm-2 col-xs-12 form_label">ユーザー</label><div class="col-md-10 col-sm-10 col-xs-12 form_radio">';
    echo $work->has('user') ? $work->user->name : $user_name;
    echo $this->Form->hidden('user_id',
        [
            'value' => $work->has('user') ? $work->user->user_id : $user_id,
        ]
    );
    echo '</div>';

    echo $this->Form->control('project_id',
        [
            'label' => [
                'text' => 'プロジェクト',
                'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
            ],
            'type' => 'select',
            'options' => $project_list,
            'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
            'empty' => false,
            'default' => 'empty'
        ]
    );

    echo '<label class="col-md-2 col-sm-2 col-xs-12 form_label">出勤時間</label><div class="col-md-10 col-sm-10 col-xs-12 form_radio">';
    echo $this->Form->control('attend_time',
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
    echo $this->Form->control('leave_time',
        [
            'label' => false,
            'empty' => false,
            'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
            'style' => 'margin-bottom: 20px;height:34px;',
            'default' => '19:00'
        ]
    );
    echo '</div>';

    echo '<label class="col-md-2 col-sm-2 col-xs-12 form_label">休憩時間</label><div class="col-md-10 col-sm-10 col-xs-12 form_radio">';
    echo $this->Form->control('break_time',
        [
            'label' => false,
            'empty' => false,
            'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
            'style' => 'margin-bottom: 20px;height:34px;',
            'default' => '19:00'
        ]
    );
    echo '</div>';

    echo $this->Form->control('remarks',
        [
            'label' => [
                'text' => '備考',
                'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
            ],
            'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
            'empty' => false,
            'default' => null,
            'maxlength' => 20
        ]
    );

    echo $this->Form->control('transport_expenses',
        [
            'label' => [
                'text' => '交通費',
                'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
            ],
            'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
            'empty' => false,
            'default' => 0,
        ]
    );

    echo $this->Form->control('location_add',
        [
            'label' => [
                'text' => '出勤場所',
                'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
            ],
            'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
            'empty' => false,
            'default' => null,
        ]
    );

    echo $this->Form->control('location_leave',
        [
            'label' => [
                'text' => '退勤場所',
                'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
            ],
            'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
            'empty' => false,
            'default' => null,
        ]
    );

    ?>

    <div class="btn_area">
        <?= $this->Form->button('登録', ['class' => 'btn btn-primary submit_btn']) ?>
    </div>
    <?= $this->Form->end() ?>
</div>
