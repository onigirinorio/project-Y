<?php
/**
 * @var \App\View\AppView $this
 */

echo $this->Html->css('Users/add', ['block' => true]);

?>

<?= $this->Form->create($user) ?>
<h3 class="h3_responsive"><?= __('ユーザー登録') ?></h3>

<?= $this->element('Users/form', ['user' => $user]) ?>

<div class="btn_area">
    <?= $this->Form->button(__('登録'), [
        'text' => '登録',
        'class' => 'btn btn-primary'
    ]) ?>
</div>
<?= $this->Form->end() ?>
