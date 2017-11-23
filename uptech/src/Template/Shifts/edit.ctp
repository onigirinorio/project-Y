<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="shifts form large-9 medium-8 columns content">
    <?= $this->Form->create($shift) ?>
    <fieldset>
        <legend><?= __('Edit Shift') ?></legend>
        <?php
        echo $this->Form->control('user_id',
            [
               'options' => $users,
               'class' => 'form-control',
            ]
        );
        echo $this->Form->control('date',
            [
                'label' => '日付',
                'class' => 'form-control',
                'type' => 'date',
                'empty' => false,
                'monthNames' => false,
            ]
        );
        echo $this->Form->control('attend',
            [
                'label' => '出勤時間',
                'class' => 'form-control',
                'empty' => false,
            ]
        );
        echo $this->Form->control('clock',
            [
                'label' => '退勤時間',
                'class' => 'form-control',
                'empty' => false,
            ]
        );
        echo $this->Form->control('holiday_flag',
            [
                'label' => '休日出勤フラグ',
                'class' => 'form-check-input',
            ]
        );
        ?>
    </fieldset>
    <?= $this->Form->button(__('編集')) ?>
    <?= $this->Form->end() ?>
</div>
