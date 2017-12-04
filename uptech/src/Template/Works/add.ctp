<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="works form large-9 medium-8 columns content">

    <? //登録ボタン用フォーム ?>
    <?= $this->Form->create($work) ?>
    <fieldset>
        <legend><?= __('勤怠登録') ?></legend>
        <?php
            echo $this->Form->hidden('user_id',
                [
                    'value' => $user_id
                ]
            );

            echo $this->Form->hidden('attend_time',
                [
                    'value' => date('H:i')
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
/*
            echo $this->Form->control('user_id',
                [
                    'options' => $users,
                    'class' => 'form-control'
                ]
            );
            echo $this->Form->control('project_id',
                [
                    'options' => $projects,
                    'class' => 'form-control'
                ]
            );
            echo $this->Form->control('attend_time',
                [
                    'label' => '出勤時間',
                    'class' => 'form-control',
                    'empty' => true,
                ]
            );
            echo $this->Form->control('leave_time',
                [
                    'label' => '退勤時間',
                    'class' => 'form-control',
                    'empty' => true,
                ]
            );
            echo $this->Form->control('break_time',
                [
                    'label' => '休憩時間',
                    'class' => 'form-control',
                    'empty' => true
                ]
            );
            echo $this->Form->control('overtime',
                [
                    'label' => '残業時間',
                    'class' => 'form-control',
                    'empty' => true
                ]
            );
*/
        ?>
    </fieldset>
    <?= $this->Form->button(__('出勤登録'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>

    <? //退勤用ボタン ?>
    <?= $this->Form->create($work, ['url' => '/works/add_leave']) ?>
    <fieldset>
        <legend><?= __('勤怠登録') ?></legend>
        <?php
            echo $this->Form->control('break_time',
                [
                    'label' => '休憩時間',
                    'class' => 'form-control',
                    'empty' => true
                ]
            );

            echo $this->Form->hidden('user_id',
                [
                    'value' => $user_id
                ]
            );

            echo $this->Form->hidden('leave_time',
                [
                    'value' => date('H:i')
                ]
            );

            echo $this->Form->hidden('project_id',
                [
                    'value' => $project
                ]
            );


/*
            echo $this->Form->control('user_id',
                [
                    'options' => $users,
                    'class' => 'form-control'
                ]
            );
            echo $this->Form->control('project_id',
                [
                    'options' => $projects,
                    'class' => 'form-control'
                ]
            );
            echo $this->Form->control('attend_time',
                [
                    'label' => '出勤時間',
                    'class' => 'form-control',
                    'empty' => true,
                ]
            );
            echo $this->Form->control('leave_time',
                [
                    'label' => '退勤時間',
                    'class' => 'form-control',
                    'empty' => true,
                ]
            );
            echo $this->Form->control('break_time',
                [
                    'label' => '休憩時間',
                    'class' => 'form-control',
                    'empty' => true
                ]
            );
            echo $this->Form->control('overtime',
                [
                    'label' => '残業時間',
                    'class' => 'form-control',
                    'empty' => true
                ]
            );
*/
        ?>
    </fieldset>
    <?= $this->Form->button(__('退勤'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
