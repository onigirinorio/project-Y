<?php
/**
 * @var \App\View\AppView $this
 */

echo $this->Html->css('Users/add', ['block' => true]);

?>

<?= $this->Form->create($user) ?>
<h3 class="legend_responsive"><?= __('ユーザー登録') ?></h3>

<?= $this->element('Users/form', ['user' => $user]) ?>

<?= $this->Form->button(__('登録'), [
    'text' => '登録',
    'class' => 'btn btn-primary'
]) ?>
<?= $this->Form->end() ?>
