<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="projects form large-9 medium-8 columns content">
    <?= $this->Form->create($project) ?>
    <fieldset>
        <legend><?= __('案件追加') ?></legend>
        <?php
//            echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
//            echo $this->Form->control('client_id', ['options' => $clients, 'empty' => true]);
            echo $this->Form->control('payment_status',
                [
                    'label' => '支払区分',
                    'type' => 'select',
                    'options' => PAYMENT_STATUS,
                    'class' =>'form-control'
                ]
            );
            echo $this->Form->control('price',
                [
                    'label' => '金額',
                    'class' =>'form-control'
                ]
            );
            echo $this->Form->control('shop_name',
                [
                    'label' => '店舗名',
                    'class' =>'form-control'
                ]
            );
            echo $this->Form->control('start__date',
                [
                    'label' => '開始日',
                    'class' =>'form-control',
                    'empty' => false,
                    'monthNames' => false,
                ]
            );
            echo $this->Form->control('end_date',
                [
                    'label' => '終了日',
                    'class' =>'form-control',
                    'empty' => false,
                    'monthNames' => false,

                ]
            );
            echo $this->Form->control('expense',
                [
                    'label' => '交通費',
                    'class' =>'form-control',
                ]
            );
            echo $this->Form->control('expense_status',
                [
                    'label' => '交通費区分',
                    'class' =>'form-control',
                ]
            );
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
