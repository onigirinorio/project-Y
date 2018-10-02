<?php
/**
 * @var \App\View\AppView $this
 */
$this->assign('title', 'パスワード変更');
?>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <h3 class="h3_responsive"><?= __('ユーザー編集') ?></h3>
    <div class="form_wrapper"></div>

    <?php
        echo $this->Form->control('password',
        [
        'label' => [
        'text' => 'パスワード',
        'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
        ],
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
        'placeholder' => '半角英数字８文字以上１６文字以下で入力してください。',
        'minlength' => '8',
        'maxlength' => '16',
        'value' => '',
        ]
        );

        echo $this->Form->control('password_check',
        [
        'label' => [
        'text' => 'パスワード(確認用)',
        'class' => 'col-md-2 col-sm-2 col-xs-12 form_label'
        ],
        'class' => 'col-md-10 col-sm-10 col-xs-12 form_input',
        'placeholder' => '半角英数字８文字以上１６文字以下で入力してください。',
        'minlength' => '8',
        'maxlength' => '16',
        'type' => 'password',
        'value' => '',
        ]
        );
    ?>

    <div class="btn_area">
        <?= $this->Form->button('編集完了', ['class' => 'btn btn-primary submit_btn']) ?>
    </div>
    <?= $this->Form->end() ?>
</div>
