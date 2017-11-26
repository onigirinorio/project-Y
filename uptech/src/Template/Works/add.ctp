<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="works form large-9 medium-8 columns content">
    <?= $this->Form->create($work) ?>
    <fieldset>
        <legend><?= __('勤怠登録') ?></legend>
        <?php
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
        ?>
    </fieldset>
    <?= $this->Form->button(__('登録')) ?>
    <?= $this->Form->end() ?>
</div>
