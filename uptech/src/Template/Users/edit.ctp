<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('編集') ?></legend>
        <?php
        echo $this->Form->control('name',
            [
                'label' => '名前',
                'class' => 'form-control',
            ]
        );
        echo $this->Form->control('name_kana',
            [
                'label' => '名前（カナ）',
                'class' => 'form-control'
            ]
        );
        echo $this->Form->control('password',
            [
                'label' => 'パスワード',
                'class' => 'form-control'
            ]
        );
        echo $this->Form->control('email',
            [
                'label' => 'メールアドレス',
                'class' => 'form-control'
            ]
        );
        echo $this->Form->control('tell',
            [
                'label' => '電話番号',
                'class' => 'form-control'
            ]
        );
        echo '<div class="form-group"><label class="mg-r-10">性別</label></br><div class="btn-group" data-toggle="buttons">';
        foreach (GENDER as $key => $gender){
            echo $this->Form->radio('gendar',
                [$key => $gender]
            );
        }
        echo '</div></div>';
        echo $this->Form->control('birth',
            [
                'label' => '生年月日',
                'empty' => false,
                'monthNames' => false,
                'maxYear' => date('Y'),
                'minYear' => date('Y') - 40,
                'class' => 'form-control'
            ]
        );
        echo $this->Form->control('zip_code',
            [
                'label' => '郵便番号',
                'class' => 'form-control'
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
        // echo $this->Form->control('work_id', ['options' => $works, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
