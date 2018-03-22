<?php
/**
  * @var \App\View\AppView $this
  */

echo $this->Html->css('Users/add', ['block' => true]);

?>
<div class="container">
    <?= $this->Form->create($user,['class' => 'form-horizontal']) ?>
    <fieldset>
        <legend><?= __('ユーザー登録') ?></legend>
        <?php
            echo $this->Form->control('name',
                [
                    'label' => '名前',
                    'class' => 'form-control',
                ]
            );
            echo $this->Form->control('name_kana',
                [
                    'label' => '名前(カナ)',
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

            echo '<div><label class="mg-r-10">性別</label></br><div class="btn-group" data-toggle="buttons">';
            foreach (GENDER as $key => $gender){
                echo $this->Form->radio('gender',
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
            echo $this->Form->control('project_id',
                [
                    'label' => 'プロジェクト',
                    'type' => 'select',
                    'options' => $project_list,
                    'class' => 'form-control'
                ]
            );
        ?>
    </fieldset>
    <?= $this->Form->button(__('登録'),[
            'text' => '登録',
            'class' => 'btn btn-primary'
    ]) ?>
    <?= $this->Form->end() ?>
</div>
