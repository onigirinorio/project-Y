<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Work $work
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Work'), ['action' => 'edit', $work->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Work'), ['action' => 'delete', $work->id], ['confirm' => __('Are you sure you want to delete # {0}?', $work->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Works'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Work'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="works view large-9 medium-8 columns content">
    <h3><?= h($work->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $work->has('user') ? $this->Html->link($work->user->name, ['controller' => 'Users', 'action' => 'view', $work->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Project') ?></th>
            <td><?= $work->has('project') ? $this->Html->link($work->project->id, ['controller' => 'Projects', 'action' => 'view', $work->project->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($work->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Attend Time') ?></th>
            <td><?= h($work->attend_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Leave Time') ?></th>
            <td><?= h($work->leave_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Break Time') ?></th>
            <td><?= h($work->break_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Overtime') ?></th>
            <td><?= h($work->overtime) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Create At') ?></th>
            <td><?= h($work->create_at) ?></td>
        </tr>
    </table>
</div>
