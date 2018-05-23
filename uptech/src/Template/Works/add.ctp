<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="works form large-9 medium-8 columns content">

    <? //登録ボタン用フォーム ?>
    <div class="area_regist_works">
        <?= $this->Form->create($work) ?>
        <h3><?= __('出勤登録') ?></h3>
        <?php
        echo $this->Form->hidden('user_id',
            [
                'value' => $user_id
            ]
        );

        echo $this->Form->hidden('project_id',
            [
                'value' => $project
            ]
        );

        echo $this->Form->hidden('leave_time',
            [
                'value' => null
            ]
        );
        ?>
        <?= $this->Form->button(__('出勤'), ['class' => 'btn btn-primary regist_work_btn']) ?>
        <?= $this->Form->end() ?>
    </div>


    <? //退勤用ボタン ?>
    <div class="area_regist_works">
        <?= $this->Form->create($work, ['url' => '/works/add_leave']) ?>
        <h3><?= __('退勤登録') ?></h3>
        <?php
        /*                echo $this->Form->control('leave_time',
							[
								'label' => '退勤時間',
								'class' => 'form-control'
							]
						); */

        echo $this->Form->control('break_time',
            [
                'label' => '休憩時間',
                'class' => 'form-control',
                'default' => '01:00'
            ]
        );

        echo '<div>';
        echo $this->Form->control('remarks',
            [
                'label' => '備考',
                'class' => 'form-control',
                'default' => ''
            ]
        );
        echo '</div>';

        echo $this->Form->control('transport_expenses',
            [
                'label' => '交通費',
                'class' => 'form-control',
                'default' => '',
                'max' => 99999999999,
            ]
        );

        echo $this->Form->hidden('leave_time',
            [
                'value' => date('H:i')
            ]
        );

        echo $this->Form->hidden('user_id',
            [
                'value' => $user_id
            ]
        );

        echo $this->Form->hidden('project_id',
            [
                'value' => $project
            ]
        );
        ?>
        <?= $this->Form->button(__('退勤'), ['class' => 'btn btn-primary regist_work_btn']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
