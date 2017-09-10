<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Shift $shift
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Shift'), ['action' => 'edit', $shift->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Shift'), ['action' => 'delete', $shift->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shift->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Shifts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Shift'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="shifts view large-9 medium-8 columns content">
    <h3><?= h($shift->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $shift->has('user') ? $this->Html->link($shift->user->name, ['controller' => 'Users', 'action' => 'view', $shift->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Create User') ?></th>
            <td><?= h($shift->create_user) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Update User') ?></th>
            <td><?= h($shift->update_user) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($shift->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($shift->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Attend') ?></th>
            <td><?= h($shift->attend) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Clock') ?></th>
            <td><?= h($shift->clock) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Create At') ?></th>
            <td><?= h($shift->create_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Upteda At') ?></th>
            <td><?= h($shift->upteda_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Holiday Flag') ?></th>
            <td><?= $shift->holiday_flag ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
