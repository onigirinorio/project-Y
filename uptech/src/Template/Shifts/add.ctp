<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Shifts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="shifts form large-9 medium-8 columns content">
    <?= $this->Form->create($shift) ?>
    <fieldset>
        <legend><?= __('Add Shift') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('date', ['empty' => true]);
            echo $this->Form->control('attend', ['empty' => true]);
            echo $this->Form->control('clock', ['empty' => true]);
            echo $this->Form->control('holiday_flag');
            echo $this->Form->control('create_user');
            echo $this->Form->control('create_at', ['empty' => true]);
            echo $this->Form->control('update_user');
            echo $this->Form->control('upteda_at', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
