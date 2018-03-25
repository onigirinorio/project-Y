<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <h3 class="h3_responsive"><?= __('ユーザー編集') ?></h3>
    <div class="form_wrapper"></div>

    <?= $this->element('Users/form', ['user' => $user]) ?>

    <div class="btn_area">
        <?= $this->Form->button('登録', ['class' => 'btn btn-primary submit_btn']) ?>
    </div>
    <?= $this->Form->end() ?>
</div>
