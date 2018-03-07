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
            echo $this->Form->control('client_id',
                [
                    'label' => 'クライアント名',
                    'type' => 'select' ,
                    'options' => $clientList,
                    'class' => 'form-control',
                ]
            );
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
            echo $this->Form->control('in_minutes',
                [
                    'label' => '分単位',
                    'type' => 'select',
                    'options' => IN_MINUTES,
                    'class' =>'form-control',
                    'default' => 2
                ]
            );
            echo $this->Form->control('shop_name',
                [
                    'label' => '店舗名',
                    'class' =>'form-control'
                ]
            );
            echo $this->Form->control('start_date',
                [
                    'label' => '開始日',
                    'class' =>'form-control',
                    'type' => 'date',
                    'empty' => false,
                    'monthNames' => false,
                ]
            );
            echo $this->Form->control('end_date',
                [
                    'label' => '終了日',
                    'class' =>'form-control',
                    'type' => 'date',
                    'empty' => false,
                    'monthNames' => false,

                ]
            );
            echo $this->Form->control('expense_status',
                [
                    'label' => '交通費区分',
                    'class' =>'form-check-input',
                ]
            );
            echo $this->Form->control('expense',
                [
                    'label' => '交通費',
                    'class' =>'form-control',
                ]
            );
        ?>
    </fieldset>
    <?= $this->Form->button(__('新規追加'),
        [
            'text' => '登録',
            'class' => 'btn btn-primary'
        ])
    ?>
    <?= $this->Form->end() ?>
</div>
