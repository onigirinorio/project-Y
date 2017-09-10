<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $work->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $work->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Works'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="works form large-9 medium-8 columns content">
    <?= $this->Form->create($work) ?>
    <fieldset>
        <legend><?= __('Edit Work') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('project_id', ['options' => $projects]);
            echo $this->Form->control('attend_time', ['empty' => true]);
            echo $this->Form->control('leave_time', ['empty' => true]);
            echo $this->Form->control('break_time', ['empty' => true]);
            echo $this->Form->control('overtime', ['empty' => true]);
            echo $this->Form->control('create_at', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
