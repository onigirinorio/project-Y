<?php
/**
 * @var \App\View\AppView $this
 */
$this->Html->script('works_admin_add', ['block' => true]);
$this->assign('title', '出退勤登録(管理者)');
?>
<div class="shifts form large-9 medium-8 columns content">
    <?= $this->Form->create($work, ['id' => 'form_admin_add']) ?>
    <h3 class="h3_responsive"><?= __('勤怠データ登録') ?></h3>

    <?php
    if ($admin_flg) {
        echo '<label class="col-md-2 col-sm-2 col-xs-12 form_label">日付</label><div class="col-md-10 col-sm-10 col-xs-12 form_date_select">';
        echo $this->Form->control('create_at',
            [
                'label' => false,
                'type' => 'date',
                'empty' => false,
                'monthNames' => false,
                'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
                'style' => 'margin-bottom: 20px;height:34px;',
                'default' => date('Y-m-d', strtotime('now')),
                'templates' => [
                    'inputContainerError' => '{{content}}{{error}}',
                ]
            ]
        );
        echo '</div>';

        echo '<label class="col-md-2 col-sm-2 col-xs-12 form_label">ユーザー</label><div class="col-md-10 col-sm-10 col-xs-12 form_radio">';
        echo $this->Form->select('user_id', $user_list,
            [
                'value' => $this->request->getQuery('search_user_id'),
                'empty' => 'ユーザーを選択してください',
                'class' => 'input form_input ',
            ]
        );
        echo '</div>';

        echo $this->Form->control('project_id',
            [
                'label' => [
                    'text' => '案件名',
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
                'default' => '1:00'
            ]
        );
        echo '</div>';
    }

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
        ]
    );

    if ($admin_flg) {
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

        echo $this->Form->control('work_location',
            [
                'label' => [
                    'text' => '勤務先',
                    'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
                ],
                'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
                'empty' => false,
                'default' => null,
            ]
        );
    }

    ?>

    <div class="btn_area">
        <?= $this->Form->button('登録', ['class' => 'btn btn-primary submit_btn']) ?>
    </div>
    <?= $this->Form->end() ?>
</div>

