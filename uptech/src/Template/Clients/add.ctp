<?php
/**
  * @var \App\View\AppView $this
  */
?>

<div class="clients form large-9 medium-8 columns content">
    <?= $this->Form->create($client,
        ['class' => 'form-horizontal']
    ) ?>
    <fieldset>
        <legend><?= __('クライアント追加') ?></legend>
        <?php
            echo $this->Form->control('client_name',
                [
                    'label' => '名前',
                    'class' => 'form-control',
                ]
            );
            echo $this->Form->control('tell',
                [
                    'label' => '電話',
                    'class' => 'form-control',
                ]
            );
            echo $this->Form->control('zip_code',
                [
                    'label' => '郵便番号',
                    'class' => 'form-control',
                ]
            );
        echo $this->Form->control('pref',
            [
                'label' =>'都道府県',
                'type' => 'select',
                'options' => PREF,
                'class' => 'form-control'
            ]
        );
        echo $this->Form->control('address',
            [
                'label' => '都道府県以降',
                'class' => 'form-control'
            ]
        );
        echo $this->Form->control('address2',
            [
                'label' => '建物名',
                'class' => 'form-control'
            ]
        );
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'),[
        'text' => '登録',
        'class' => 'btn btn-default'
    ]) ?>
    <?= $this->Form->end() ?>
</div>
